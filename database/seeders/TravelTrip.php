<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
class TravelTrip extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=\Faker\Factory::create();
        for($i=1;$i<=100;$i++){
            \App\Models\Createtrip::create([
                'traveller_id'=>rand(1,99),
                'trip_title'=>$faker->name,
                'short_message'=>$faker->address,
                'desination_name'=>$faker->city,
                'start_date'=>$faker->date('Y-m-d'),
                'end_date'=>$faker->date('Y-m-d'),
                'cost'=>rand(1111,9999),
                'promo_code'=>Str::random(7),
                'discount_type'=>rand(111,444),
                'hotlocation'=>rand(0,1),
                'status'=>rand(1,5),
            ]);
        }
        for($i=1;$i<=100;$i++){
            \App\Models\CreateTravel::create([
                'First_Name'=>$faker->name,
                'Last_Name'=>$faker->name,
                'email'=>$faker->safeEmail,
                'Contact_No'=>"98".rand(11111111,99999999),
            ]);
        }
        for($i=1;$i<=100;$i++){
            \App\Models\User::create([
                'firstname'=>$faker->name,
                'lastname'=>$faker->name,
                'email'=>$faker->safeEmail,
                'mobile'=>"98".rand(11111111,99999999),
            ]);
        }
        for($i=1;$i<=100;$i++){
            \App\Models\Enquiry::create([
                'traveller_id'=>rand(1,99),
                'title'=>$faker->text,
                'query'=>$faker->text,
            ]);
        }
        for($i=1;$i<=100;$i++){
            \App\Models\FacingIssue::create([
                'name'=>$faker->name,
                'title'=>$faker->text,
                'email'=>$faker->safeEmail,
                'phone_no'=>"98".rand(11111111,99999999),
                'details'=>$faker->text,
            ]);
        }
        for($i=1;$i<=100;$i++){
           \App\Models\UserReview::create([
                'user_id'=>rand(1,99),
                'trip_id'=>rand(1,99),
                'rating'=>rand(1,5),
                'review'=>$faker->text,
            ]);
        }
        
    }
}