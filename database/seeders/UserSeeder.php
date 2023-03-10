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
                'profile_picture' => 'img',
            ),

            array(
                'name' => 'airto', 
                'email' => 'airto@intermixmanagement.nl', 
                'password' => 'Vugt2003@',
                'profile_picture' => 'img',
            ),

            array(
                'name' => 'Dennis', 
                'email' => 'dennis@dennismail.nl', 
                'password' => 'Dennis2003@',
                'profile_picture' => 'img',
            ),
            array(
                'name' => 'Tyler', 
                'email' => 'Tyler@Tylermail.nl', 
                'password' => 'Tyler2003@',
                'profile_picture' => 'img',
            ),
        );
        foreach ($users as $user){
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'profile_picture' => $user['profile_picture'],
            ]);
        }
    }
}
