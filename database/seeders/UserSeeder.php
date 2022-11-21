<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
      {
        //Get admin role from role table
        $role_admin = Role::where('name', 'admin')->first();
        //Get user role from role table
        $role_user = Role::where('name', 'user')->first();
        
        $admin = new User();
        $admin->name = 'Judie GG';
        $admin->email = 'jthegd@gmail.com';
        $admin->password = Hash::make('password');
        $admin ->save();

        //attatch admin role to user above
        $admin->roles()->attach($role_admin);
        
        
        $user = new User();
        $user->name = 'Jack Heffernan';
        $user->email = 'jack@predator.ie';
        $user->password = Hash::make('password');
        $user->save();
        //Attatch user role to user
        $user->roles()->attach($role_user);
    }
}