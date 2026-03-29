<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Créer l'utilisateur
        $user = User::create([
            'name' => 'John doe',
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ]);

        // 2. Créer le rôle (Correction du guard_name ici)
        $role = Role::create([
            'name' => $user->name, 
            'guard_name' => 'web' // Indispensable pour que @can() fonctionne
        ]);

        // 3. Récupérer toutes les permissions existantes
        $allPermissionIds = Permission::pluck('id');

        // 4. Assigner toutes les permissions au rôle
        // Note : Si vous utilisez Spatie, préférez $role->syncPermissions($allPermissionIds);
        $role->permissions()->sync($allPermissionIds);

        // 5. Assigner le rôle à l'utilisateur
        // Note : Si vous utilisez Spatie, préférez $user->assignRole($role);
        $user->roles()->attach($role->id);
    }
}
