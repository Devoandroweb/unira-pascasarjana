<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::whereEmail('admin@gmail.com')->update([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'role' =>  'admin',
            'password' => bcrypt('admin'),
            'email_verified_at' => now()
        ]);
    }
}
