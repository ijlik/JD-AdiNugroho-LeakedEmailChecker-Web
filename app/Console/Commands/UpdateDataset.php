<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateDataset extends Command
{
    protected $signature = 'update:dataset';

    public function handle()
    {
        $text = $this->curl();
        $filePath = 'database/breach.json';
        file_put_contents($filePath, $text);
    }

    private function curl(): string
    {
        $response = Http::withHeaders([
            'User-Agent' => 'PostmanRuntime/7.32.2',
        ])->get('https://haveibeenpwned.com/api/v3/breaches');

        return $response->body();
    }
}
