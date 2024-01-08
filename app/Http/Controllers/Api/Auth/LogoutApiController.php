<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Utils\BaseJsonResponse;
use Illuminate\Http\{JsonResponse, Request};
use Laravel\Sanctum\PersonalAccessToken;

class LogoutApiController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        /** @var PersonalAccessToken */
        $token = $request->user()->currentAccessToken();

        $token->delete();

        return BaseJsonResponse::success('Logged out successfully', [], 204);
    }
}
