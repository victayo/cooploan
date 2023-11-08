<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = 'MOCN00001';
        $role = Role::create([
            'name' => 'admin',
            'description' => ''
        ]);

        $permission = RoleUser::create([
            'user_id' => $userId,
            'role_id' => $role->id
        ]);
    }
}
