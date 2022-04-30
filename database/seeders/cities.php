<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class cities extends Seeder
{
    private function data()
    {
        $data = [
            '1' => 'مصر',
            '2' => 'المنصوره' ,
            '3' => 'طنطا',
            '4' => 'كفرالشيخ'

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
            \App\Models\Countrie::create([
             'name' =>  $arr[$i + 1] ,
         ]);
         
        }
    }
}
