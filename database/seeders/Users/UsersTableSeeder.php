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
        $admin = User::updateOrCreate([
            'email' => 'admin@admin.com'
        ],[
            'name' => 'Andrey',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');
    }
}
