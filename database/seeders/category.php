<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = array(
            
            'Cultuur',
            'Creativiteit',
            'Muziek',
            'Eten',
            'Lifestyle',
            'Tyler',
            'Techniek',
            'Dier',
            'Motorvoertuigen',
            'Kleding',
            'Verhaal',
        );
        foreach ($category as $single){
            DB::table('category')->insert([
                'name' => $single,
            ]);
        }
    }
}
