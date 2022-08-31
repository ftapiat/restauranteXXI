<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\AccountNotExistsException;
use App\Http\Requests\SanctumAuthLoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\SanctumAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

/**
 * Controla la autenticación de usuarios.
 */
class SanctumAuthController extends ApiController
{
    /**
     * Autentica el usuario y genera un token de acceso.
     * @param SanctumAuthLoginRequest $request
     * @return JsonResponse
     * @throws ValidationException
     * @throws AccountNotExistsException
     */
    public function login(SanctumAuthLoginRequest $request): JsonResponse
    {
        $credentials = $request->only(['username', 'password', 'device']);
        /** @var User|null $user */
        $user = User::query()->where('email', $credentials['username'])->first();
        if ($user === null) {
            throw new AccountNotExistsException();
        }


        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Correo o Contraseña incorrecta.'],
            ]);
        }

        # Obtiene Token y elimina el token anterior si ya existió
        $token = (new SanctumAuthService())->syncAndGetToken($user, $credentials['device']);
        return $this->ok(['token' => $token]);
    }

    /**
     * Obtiene datos del Usuario autenticado.
     * @return JsonResponse
     */
    public function user(Request $request){
        $user = $request->user();
        $user->load('roles');
        return $this->ok(new UserResource($user));
    }

    /**
     * Elimina el Token actual del Usuario
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return $this->ok();
    }
}
