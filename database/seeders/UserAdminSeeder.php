<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataSuperAdmin = [
            'name' => 'super admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('quote123'),
            'email_verified_at' => now(),
        ];

        $dataAdmin = [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('quote123'),
            'email_verified_at' => now(),
        ];

        $saveDataSuperAdmin = User::create($dataSuperAdmin);
        $saveDataAdmin = User::create($dataAdmin);

        $saveDataSuperAdmin->assignRole('superadmin');
        $saveDataAdmin->assignRole('admin');
    }
}
