<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public const users = array(

    );

    public function run()
    {
        $users = array(
            array(
                'name' => 'rowin', 
                'email' => 'rowin@intermixmanagement.nl', 
                'password' => 'Bodegom2003@',
                'username' => 'slashclone',
                'description' => 'Ik ben gewoon een lopende meme. Ik hou van grappen maken en zal waarschijnlijk alleen maar memes posten. Dus wees bereid voor de slechtste memes die je ooit gaat zien',
                'profile_picture' => null,
                'profile_banner' => null,
            ),

            array(
                'name' => 'airto', 
                'email' => 'airto@intermixmanagement.nl', 
                'password' => 'Vugt2003@',
                'username' => 'gayfish',
                'description' => 'Voor het geval dat je wilt weten waarom ik gayfish heet. Het is nogal een lang verhaal. Ooit starte ik een pokemon platinum game en zocht naar een goede gebruikers naam en dacht OOH JA gayfish jammer genoeg zag een docent dit en hierdoor heb ik de bijnaam gayfish gekregen.',
                'profile_picture' => null,
                'profile_banner' => null,
            ),

            array(
                'name' => 'Dennis', 
                'email' => 'dennis@dennismail.nl', 
                'password' => 'Dennis2003@',
                'username' => 'Nolife',
                'description' => 'Wat had je verwacht. Je gaat naar mijn profile om tekijken naar deze prachtige rotzooi van een posts',
                'profile_picture' => null,
                'profile_banner' => null,
            ),
            array(
                'name' => 'Tyler', 
                'email' => 'Tyler@Tylermail.nl', 
                'password' => 'Tyler2003@',
                'username' => 'TylerGod69',
                'description' => 'Ik ben damian vaartmans zijn secret boyfriend hehe. Hoop dat je houd van mijn posts ze gaan allemaal over hoe hard vaartmans voor me simped',
                'profile_picture' => null,
                'profile_banner' => null,
            ),
        );
        foreach ($users as $user){
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'username' => $user['username'],
                'description' => $user['description'],
                'profile_picture' => $user['profile_picture'],
                'profile_banner' => $user['profile_banner'],
            ]);
        }
    }
}
