<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoftwareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Documentation',
            'url' => 'http://localhost:8010',
            'description' => 'Complete your on-boarding process',
            'icon' => 'main_menu/images/documentation.svg'
        ];

        DB::table('softwares')->insert($data);
    }
}
