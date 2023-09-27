<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'api']);
        $admin = Role::create(['name' => 'admin', 'guard_name' => 'api']);
        $user = Role::create(['name' => 'user', 'guard_name' => 'api']);
    }
}
