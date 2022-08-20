<?php

namespace Database\Seeders;

use App\Models\Other\Constants\RolesConstants;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesSeeder extends Seeder
{
    /**
     * Registra los roles necesarios para la aplicación.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            RolesConstants::ADMINISTRATOR,
            RolesConstants::CLIENT,
            RolesConstants::WAREHOUSE,
            RolesConstants::FINANCE,
            RolesConstants::KITCHEN,
        ];

        # Le agrega la key "name" a cada rol, para que Laravel lo interprete como el nombre de la columna
        #  Ejemplo: ['administrador'] -> ['name' => 'administrador']
        $roles = array_map(static function($role){
            return ['name' => $role];
        }, $roles);

        Role::query()->upsert($roles, ['name'], ['name']); # Guarda solo los roles que no se repitan
    }
}
