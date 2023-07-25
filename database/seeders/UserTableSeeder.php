<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'System',
            'last_name' => 'Admin',
            'username' => 'systemadmin',
            'email' => 'system@admin.com',
            'password' => bcrypt('password'),
            'phone_number' => '+12398190255',
            'email_verified_at' => now(),
            'user_type' => 'admin',
            'status' => 'active',
        ]);
        User::create(
            [
            'first_name' => 'Demo',
            'last_name' => 'Admin',
            'username' => 'demoadmin',
            'email' => 'demo@example.com',
            'password' => bcrypt('password'),
            'phone_number' => '+12398190257',
            'email_verified_at' => now(),
            'user_type' => 'user',
        ]
        );
    }
}
