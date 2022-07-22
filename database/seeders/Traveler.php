<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CreateTravel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Traveler extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $newUser = CreateTravel::create([
                'First_Name' => 'Traveller',
                'Contact_No' => '9876532091',
                'email' => 'traveller@traveller.com',
                'password' => Hash::make('1234567890'),
            ]);
      
            // $newUser->assignRole('Traveller');
    }
}