<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchEmailRequest;
use App\Services\EmailBreachService;

class LandingController extends Controller
{
    protected $emailBreachService;

    public function __construct(EmailBreachService $emailBreachService)
    {
        $this->emailBreachService = $emailBreachService;
    }

    public function index()
    {
        return view('index', [
            'search' => false,
            'data' => [],
            'error' => null,
            'email' => null,
        ]);
    }

    public function search(SearchEmailRequest $request)
    {
        $result = $this->emailBreachService->searchBreaches($request['email']);

        return view('index', [
            'search' => true,
            'data' => $result['data'],
            'error' => $result['error'],
            'email' => $request['email'],
        ]);
    }
}
