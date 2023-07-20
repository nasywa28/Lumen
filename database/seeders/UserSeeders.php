<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin',
            'password' => bcrypt('admin123'),
            ]);
            $admin->assignRole('admin');
            $user = User::create([
            'name' => 'User',
            'email' => 'user@user',
            'password' => bcrypt('user123'),
            ]);
            $user->assignRole('user');
            
    }
}
