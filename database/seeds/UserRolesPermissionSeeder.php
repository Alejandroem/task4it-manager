<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        app()['cache']->forget('spatie.permission.cache');
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'project-manager']);
        $role = Role::create(['name' => 'developer']);       
        $role = Role::create(['name' => 'client']);       
        
    }
}
