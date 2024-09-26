<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //admin data
            [
                'name' =>'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                
            ],

            //user or customer data
            [
                'name' =>'Customer',
                'email' => 'customer@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'customer',
               
            ],
        ]);
    }
}
