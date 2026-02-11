<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteDetailsSeeder extends Seeder
{
    public function run()
    {
        DB::table('website_details')->insert([
            'id' => 1,
            'phone' => '+91-9876543210',
            'email' => 'info@anmayfoundation.org',
            'address' => 'Anmay Foundation, New Delhi, India',
            'instagram' => 'https://www.instagram.com/anmayfoundation',
            'twitter' => 'https://twitter.com/anmayfoundation',
            'facebook' => 'https://www.facebook.com/anmayfoundation',
            'linkedin' => 'https://www.linkedin.com/company/anmayfoundation',
            'youtube' => 'https://www.youtube.com/@anmayfoundation',
            'created_at' => '2026-02-09 07:11:55',
            'updated_at' => '2026-02-09 07:11:55',
        ]);
    }
}
