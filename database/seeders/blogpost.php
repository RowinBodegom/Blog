<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class blogpost extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = array(
            array(
                'title' => 'nice weather', 
                'text' => 'its such nice weather outside.', 
                'userID' => 1, 
            ),

            array(
                'title' => 'sunny weather', 
                'text' => 'i love the sunny weather it gives me a tan!', 
                'userID' => 1, 
            ),

            array(
                'title' => 'rainy weather', 
                'text' => 'the rain from this rainy weather is giving my plants water.', 
                'userID' => 2, 
            ),

            array(
                'title' => 'stormy weather', 
                'text' => 'i just saw lighting strike a bush it was awesome!', 
                'userID' => 3, 
            ),

            array(
                'title' => 'windy weather', 
                'text' => 'this wind is blowing out all this candles that i put in my window.',
                'userID' => 2,  
            ),
        );
        foreach ($posts as $post){
            DB::table('blogposts')->insert([
                'title' => $post['title'],
                'text' => $post['text'],
                'madedate' =>  date("Y-m-d H:i:s"),
                'userID' => $post['userID'],
            ]);
        }
    }
}
