<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\BaseJsonResponse;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\{Auth, Validator};

class LoginApiController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validateLogin(Request $request)
    {
        return Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'O campo email é obrigatório',
            'email.email'       => 'O campo email deve ser um email válido',
            'password.required' => 'O campo senha é obrigatório',
        ]);
    }

    public function __invoke(Request $request): JsonResponse
    {
        $validator = $this->validateLogin($request);

        if ($validator->fails()) return BaseJsonResponse::error($validator->errors(), 401);

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return BaseJsonResponse::error('Credenciais inválidas', 401);
        }

        /** @var User $user */
        $user = Auth::user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return BaseJsonResponse::success("Login realizado com sucesso!", [
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ]);
    }
}
