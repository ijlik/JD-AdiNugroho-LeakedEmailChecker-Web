<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchEmailRequest;
use App\Http\Resources\BreachResource;
use App\Services\EmailBreachService;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class EmailBreachController extends Controller
{
    protected $emailBreachService;

    public function __construct(EmailBreachService $emailBreachService)
    {
        $this->emailBreachService = $emailBreachService;
    }

    /**
     * Search for email breaches
     *
     * @param SearchEmailRequest $request
     * @return JsonResponse
     */
    public function search(SearchEmailRequest $request): JsonResponse
    {
        try {
            $email = $request->validated()['email'];
            $result = $this->emailBreachService->searchBreaches($email);

            return response()->json([
                'success' => true,
                'email' => $email,
                'searched' => true,
                'breaches_found' => count($result['data']),
                'error' => $result['error'],
                'data' => BreachResource::collection($result['data']),
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while searching for breaches',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
