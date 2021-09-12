<?php

namespace Database\Seeders\Users;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = config('roles');
        foreach ($roles['roles'] as $role) {
            Role::firstOrCreate([
                'name' => $role
            ]);
        }
        foreach ($roles['permissions'] as $permissionKey => $permission) {
            foreach ($permission as $type) {
                Permission::firstOrCreate([
                    'name' => $type . '-' . $permissionKey,
                ]);
            }
        }
        
    }
}
