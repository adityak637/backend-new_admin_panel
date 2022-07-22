<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         if (User::get()->count() == 0){
            $newUser = User::create([
                'firstname' => 'Super Admin',
                'email' => 'superadmin@admin.com',
                'role' => 'admin',
                'password' => Hash::make('1234567890'),
            ]);

            $newUser->assignRole('admin');
        }

        if (User::get()->count() == 1){
            $newUser = User::create([
                'firstname' => 'Test User',
                'email' => 'testuser@mailinator.com',
                'password' => Hash::make('1234567890'),
            ]);

            $newUser->assignRole('user');
        }
    }
}