<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'password' => bcrypt('admin'),
        ]);
        $admin->assignRole('admin');
        $admin = User::create([
            'name' => 'projectm',
            'email' => 'projectm@projectm.com',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'password' => bcrypt('projectm'),
        ]);
        $admin->assignRole('project-manager');
        $admin = User::create([
            'name' => 'developer',
            'email' => 'developer@developer.com',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'password' => bcrypt('developer'),
        ]);
        $admin->assignRole('developer');
        $admin = User::create([
            'name' => 'client',
            'email' => 'client@client.com',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'password' => bcrypt('client'),
        ]);
        $admin->assignRole('client');
    }
}
