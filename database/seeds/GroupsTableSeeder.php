<?php

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
        $group = factory(\App\Group::class)->times(3)->make();

        \App\Group::query()->insert($group->toArray());
    }
}
