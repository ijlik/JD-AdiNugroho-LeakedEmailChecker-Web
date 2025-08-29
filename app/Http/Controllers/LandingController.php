<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LandingController extends Controller
{
    public function index()
    {
        return view('index', [
            'search' => false,
            'data' => [],
            'error' => null,
            'email' => null,
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string']
        ]);
        $found = $this->crawl($request['email']);
        return view('welcome', [
            'search' => true,
            'data' => $found['data'],
            'error' => $found['error'],
            'email' => $request['email'],
        ]);
    }

    private function crawl($email): array
    {
        $sites = collect(json_decode(file_get_contents(__DIR__ . '/../../../database/breach.json'), true));
        $data = $this->curl($email);
        if (isset($data['message'])) {
            return [
                'error' => $data['message'],
                'data' => []
            ];
        }

        return [
            'error' => null,
            'data' => $sites->whereIn('Name', collect($data)->pluck('Name')->toArray())->toArray()
        ];
    }

    private function curl($email): array
    {
        $response = Http::withHeaders([
            'hibp-api-key' => env('HIBP_API'),
            'User-Agent'   => 'PostmanRuntime/7.32.2',
        ])->get('https://haveibeenpwned.com/api/v3/breachedaccount/' . $email);

        $data = $response->json();
        return $data === null ? [] : $data;
    }
}
