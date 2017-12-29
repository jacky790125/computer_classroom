<?php

use App\Group;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::truncate();

        Group::create([
            'name' => '系統管理員',
        ]);
        Group::create([
            'name' => '資訊教師',
        ]);
    }
}
