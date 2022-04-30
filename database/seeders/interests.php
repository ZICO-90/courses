<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class interests extends Seeder
{
    private function data()
    {
        $data = [
            '1' => 'php',
            '2' => 'java' ,
            '3' => 'csharp',
            '4' => 'javascript'

        ];

        return $data ;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $arr =  $this->data();
       for ($i=0; $i < sizeof($arr) ; $i++) { 
        \App\Models\Interest::create([
            'name' =>  $arr[$i + 1] ,
        ]);
        
       }
    }
}
