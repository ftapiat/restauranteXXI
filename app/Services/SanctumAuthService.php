<?php

namespace App\Services;

use App\Models\User;

/**
 * Servicio de autenticación API mediante Sanctum.
 */
class SanctumAuthService
{
    /**
     * Genera un token para el usuario, o lo actualiza si ya existe el dispositivo asociado.
     *
     * @param User $user
     * @param string $deviceName
     * @return string
     */
    public function syncAndGetToken(User $user, string $deviceName): string
    {
        $this->destroyTokenByDeviceName($user, $deviceName);
        return $user->createToken($deviceName)->plainTextToken;
    }

    /**
     * Destruye token del usuario por nombre de dispositivo.
     *
     * @param User $user
     * @param string $deviceName
     * @return void
     */
    private function destroyTokenByDeviceName(User $user, string $deviceName): void
    {
        $user->tokens()->where('name', $deviceName)->delete();
    }
}
