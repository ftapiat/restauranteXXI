<?php

namespace Database\Seeders;

use App\Models\Other\Constants\RolesConstants;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createUsers();
        $this->assignRoles();
    }

    private function createUsers(): void{
        $users = [
            [
                'name' => 'Administrador',
                'email' => 'admin@restaurante.com',
                'password' => Hash::make('admin')
            ],
        ];
        User::query()->upsert($users, ['email'], ['name', 'email', 'password']);
    }

    private function assignRoles(): void{
        $userRoles = [
            [
                'email' => 'admin@admin.com',
                'roles' => [RolesConstants::ADMINISTRATOR]
            ]
        ];

        foreach ($userRoles as $userRole){
            /** @var User|null $user */
            $user = User::query()->where('email', $userRole['email'])->first();
            $user?->syncRoles($userRole['roles']);
        }
    }
}
