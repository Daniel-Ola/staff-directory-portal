<?php

use App\GroupHeadRole;
use Illuminate\Database\Seeder;

class GroupHeadRoleSeeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return GroupHeadRole::create([
            'name' => 'Group Chief Auditor'
        ]);
    }
}
