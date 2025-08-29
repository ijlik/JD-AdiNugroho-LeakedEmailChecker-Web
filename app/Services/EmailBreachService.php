<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class EmailBreachService
{
    /**
     * Search for email breaches
     *
     * @param string $email
     * @return array
     */
    public function searchBreaches(string $email): array
    {
        $sites = $this->getBreachDatabase();
        $filePath = storage_path('app/public/'.now()->format('Y-m') . '-leak-data.json');
        $breachData = null;
        if (file_exists($filePath)) {
            $fileBreaches = collect(json_decode(file_get_contents($filePath), true))->where('email', $email)->first();
            if ($fileBreaches) {
                $breachData = $fileBreaches['result'];
            }
        }

        if (!file_exists($filePath)) {
            $breachData = $this->fetchFromHaveIBeenPwned($email);
            if (isset($breachData['message'])) {
                return [
                    'error' => $breachData['message'],
                    'data' => []
                ];
            }
            file_put_contents($filePath, json_encode([
                ['email' => $email, 'result' => $breachData]
            ]));
        }

        if ($breachData === null) {
            $breachData = $this->fetchFromHaveIBeenPwned($email);
            if (isset($breachData['message'])) {
                return [
                    'error' => $breachData['message'],
                    'data' => []
                ];
            }

            $currentData = json_decode(file_get_contents($filePath), true);
            $currentData[] = ['email' => $email, 'result' => $breachData];
            file_put_contents($filePath, json_encode($currentData));
        }

        $breaches = $sites->whereIn('Name', collect($breachData)->pluck('Name')->toArray())
            ->sortByDesc('BreachDate')
            ->values()
            ->toArray();

        return [
            'error' => null,
            'data' => $breaches
        ];
    }

    /**
     * Get the breach database from JSON file
     *
     * @return Collection
     */
    private function getBreachDatabase(): Collection
    {
        $path = database_path('breach.json');
        $json = file_get_contents($path);
        return collect(json_decode($json, true));
    }

    /**
     * Fetch breach data from HaveIBeenPwned API
     *
     * @param string $email
     * @return array
     */
    private function fetchFromHaveIBeenPwned(string $email): array
    {
        try {
            $response = Http::withHeaders([
                'hibp-api-key' => env('HIBP_API'),
            ])->timeout(30)
              ->get('https://haveibeenpwned.com/api/v3/breachedaccount/' . $email);

            if ($response->failed()) {
                if ($response->status() === 404) {
                    return []; // No breaches found
                }

                if ($response->status() === 401) {
                    return [
                        'message' => 'Invalid API key'
                    ];
                }

                if ($response->status() === 429) {
                    return [
                        'message' => 'Rate limit exceeded. Please try again later.'
                    ];
                }

                return [
                    'message' => 'API request failed with status: ' . $response->status()
                ];
            }

            $data = $response->json();
            return $data === null ? [] : $data;

        } catch (\Exception $e) {
            return [
                'message' => 'Failed to fetch breach data: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Get breach statistics
     *
     * @return array
     */
    public function getBreachStatistics(): array
    {
        $sites = $this->getBreachDatabase();

        return [
            'total_breaches' => $sites->count(),
            'total_accounts' => $sites->sum('PwnCount'),
            'latest_breach' => $sites->sortByDesc('BreachDate')->first()['BreachDate'] ?? null,
        ];
    }
}
