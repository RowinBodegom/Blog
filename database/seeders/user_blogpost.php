<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class user_blogpost extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $links = array(
            array(
                'userID' => '1', 
                'blogpostID' => '1', 
            ),

            array(
                'userID' => '1', 
                'blogpostID' => '2', 
            ),

            array(
                'userID' => '2', 
                'blogpostID' => '3', 
            ),

            array(
                'userID' => '2', 
                'blogpostID' => '4', 
            ),

            array(
                'userID' => '3', 
                'blogpostID' => '5', 
            ),
        );
        foreach ($links as $link){
            DB::table('user_blogposts')->insert([
                'userID' => $link['userID'],
                'blogpostID' => $link['blogpostID'],
            ]);
        }
    }
}
