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
        $projectm = User::create([
            'name' => 'projectm',
            'email' => 'projectm@projectm.com',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'password' => bcrypt('projectm'),
        ]);
        $projectm->assignRole('project-manager');
        $developer = User::create([
            'name' => 'developer',
            'email' => 'developer@developer.com',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'password' => bcrypt('developer'),
        ]);
        $developer->assignRole('developer');
        $client = User::create([
            'name' => 'client',
            'email' => 'client@client.com',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'password' => bcrypt('client'),
        ]);
        $client->assignRole('client');
        $client->givePermissionTo('create');

    }
}
