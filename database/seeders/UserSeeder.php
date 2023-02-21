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
            'password' => 'Bodegom2003@'
            ),

            array(
                'name' => 'airto', 
                'email' => 'airto@intermixmanagement.nl', 
                'password' => 'Vugt2003@'
            ),
        );
        
        DB::table('users')->insert($users);
    }
}
