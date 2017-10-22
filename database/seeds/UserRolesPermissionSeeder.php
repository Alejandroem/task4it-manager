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
        Role::create(['name' => 'admin','display_name'=>'Administrator','level'=>1]);
        Role::create(['name' => 'project-manager','display_name'=>'Project Manager','level'=>2]);
        Role::create(['name' => 'developer','display_name'=>'Developer','level'=>3]);       
        Role::create(['name' => 'client','display_name'=>'Client','level'=>4]);
        Permission::create(['name' => 'create']);       
        
    }
}
