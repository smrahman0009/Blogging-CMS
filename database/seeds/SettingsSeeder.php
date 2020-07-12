<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $setting = Setting::create(
            [
                'site_name' => "Web World",
                'contact_number' => '01739814872',
                'contact_email' => 'web@info.com',
                'address' => "Lake City, Dhaka"
            ]
       );
    }
}
