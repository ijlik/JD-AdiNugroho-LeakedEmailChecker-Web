<?php

use App\Http\Controllers\Api\EmailBreachController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Email breach search endpoint
Route::post('/search', [EmailBreachController::class, 'search'])
    ->middleware('throttle:6000,1'); // 6000 requests per minute

// API documentation endpoint
Route::get('/', function () {
    return response()->json([
        'name' => 'Leaked Email Checker API',
        'version' => '1.0.0',
        'description' => 'API for checking if an email address has been compromised in data breaches',
        'endpoints' => [
            [
                'method' => 'POST',
                'path' => '/api/search',
                'description' => 'Search for email breaches',
                'parameters' => [
                    'email' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Email address to check for breaches'
                    ]
                ],
                'example_request' => [
                    'email' => 'test@example.com'
                ],
                'example_response' => [
                    'success' => true,
                    'email' => 'test@example.com',
                    'searched' => true,
                    'breaches_found' => 2,
                    'error' => null,
                    'data' => [
                        [
                            'name' => 'ExampleBreach',
                            'title' => 'Example Breach',
                            'domain' => 'example.com',
                            'breach_date' => '2020-01-01',
                            'pwn_count' => 1000000,
                            'description' => 'Example breach description',
                            'data_classes' => ['Email addresses', 'Passwords'],
                            'is_verified' => true,
                            'is_sensitive' => false
                        ]
                    ]
                ]
            ]
        ]
    ]);
});
