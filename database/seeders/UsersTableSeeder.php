<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Anmay Admin',
            'email' => 'admin@anmay.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // You can change the password
            'remember_token' => Str::random(60),
            'created_at' => '2026-02-06 04:45:49',
            'updated_at' => '2026-02-10 05:25:04',
        ]);
    }
}
