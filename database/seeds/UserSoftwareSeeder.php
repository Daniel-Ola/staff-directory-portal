<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSoftwareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_softwares')->insert([
            'user_id' => 32,
            'software_id' => 1,
            'attribute' => 'can'
        ]);
    }
}
