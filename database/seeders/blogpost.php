<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BlogPost extends Seeder
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
                'user_id' => 1, 
            ),

            array(
                'title' => 'sunny weather', 
                'text' => 'i love the sunny weather it gives me a tan!', 
                'user_id' => 1, 
            ),

            array(
                'title' => 'rainy weather', 
                'text' => 'the rain from this rainy weather is giving my plants water.', 
                'user_id' => 2, 
            ),

            array(
                'title' => 'stormy weather', 
                'text' => 'i just saw lighting strike a bush it was awesome!', 
                'user_id' => 3, 
            ),

            array(
                'title' => 'windy weather', 
                'text' => 'this wind is blowing out all this candles that i put in my window.',
                'user_id' => 3,  
            ),

            array(
                'title' => 'snowy weather', 
                'text' => "my car got snowed in and i have to be at work in 5 min :'(",
                'user_id' => 3,  
            ),

            array(
                'title' => 'sandy weather', 
                'text' => 'HELP ME I KEEP GETTING SAND IN MY EYES! IT HURTS SO MUCH! oh thank for the glasses. still sandy tho',
                'user_id' => 2,  
            ),
            array(
                'title' => 'Waarom zweden niet echt is', 
                'text' => 'ben je ooit in zweden geweest? JA DAT DACHT IK AL ZWEDEN IS NIET ECHT!',
                'user_id' => 4,  
            ),
            array(
                'title' => 'boeken zijn cool!', 
                'text' => 'wie hou ik voor de gek boeken zijn alleen cool wanneer je ze gooit naar blikjes als een soort carnivals spelletje',
                'user_id' => 4,  
            ),
            array(
                'title' => 'voedsel gevecht', 
                'text' => 'ben bang voor kroketen de laatste keer dat we een voedsel gevecht hadden kreeg ik een hete kroket in mijn gezicht. ik had een rood gezicht voor de hele zomer. WAAROM WAS DIE KROKET UBERHAUBT ZO HEET!',
                'user_id' => 4,  
            ),
        );
        foreach ($posts as $post){
            DB::table('blogposts')->insert([
                'title' => $post['title'],
                'text' => $post['text'],
                'user_id' => $post['user_id'],
            ]);
        }
    }
}
