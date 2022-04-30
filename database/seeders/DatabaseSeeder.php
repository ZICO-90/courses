<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            about::class,
            cities::class,
            interests::class,
            PrivacyPolicy::class,
            studentLogin::class,
            instructorLogin::class,
            ask::class,
            adminLogin::class,
        ]);
    }
}
