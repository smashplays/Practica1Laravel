<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'name' => 'SmashPlays',
            'age' => 23,
            'password' => '12345678Aa',
            'email' => 'smashplays@smashplays.com',
            'gender' => 'male'
        ]);
        DB::table('students')->insert([
            'name' => 'HeilGio',
            'age' => 23,
            'password' => '12345678Aa',
            'email' => 'heil@gio.com',
            'gender' => 'female'
        ]);
        DB::table('students')->insert([
            'name' => 'Clausonfire',
            'age' => 23,
            'password' => '12345678Aa',
            'email' => 'claus@onfire.com',
            'gender' => 'female'
        ]);
        DB::table('students')->insert([
            'name' => 'TakaroLoWeno',
            'age' => 23,
            'password' => '12345678Aa',
            'email' => 'takaro@loweno.com',
            'gender' => 'male'
        ]);
        DB::table('students')->insert([
            'name' => 'MaxEsquiva',
            'age' => 25,
            'password' => '12345678Aa',
            'email' => 'max@esquiva.com',
            'gender' => 'male'
        ]);
        DB::table('students')->insert([
            'name' => 'Galipienso',
            'age' => 21,
            'password' => '12345678Aa',
            'email' => 'galipienso@galiexisto.com',
            'gender' => 'male'
        ]);
    }
}
