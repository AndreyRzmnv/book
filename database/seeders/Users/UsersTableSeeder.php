<?php

namespace Database\Seeders\Users;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::firstOrCreate([
            'email' => 'admin@admin.com'
        ],[
            'name' => 'Andrey',
            'password' => '$2y$10$e6AzNjBKW6NyUavKn9clVur3s0.g601OzjstAIw9kE5HH4M2OOAjK',
        ]);
        $admin->assignRole('admin');
    }
}
