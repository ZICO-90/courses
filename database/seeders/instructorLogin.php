<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class instructorLogin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'username' => "ahmed abdullah",
            'full_name' => "ahmed abdullah",
            'phone' =>"01024968000",
            'email' => "instructor@gmail.com",
            'password' => Hash::make("ahmed123"),
            'gender' => "1", //	[ 1 > male , 2 > female ]
            'is_work' => '1', // 	[ 1 > instructor , 2 > student , 3 > both ]
            'is_view' => ["1","2"],
            'country_id' => 1,
            'policyactivation' => 1,
            'email_verified' => 1,
            
        ]);
    }
}
