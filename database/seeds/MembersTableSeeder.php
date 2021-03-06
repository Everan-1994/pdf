<?php

use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group_ids = \App\Group::all()->pluck('id')->toArray();

        $members = factory(\App\Member::class)
            ->times(150)
            ->make()
            ->each(function ($member, $index)
            use ($group_ids)
            {
                if ($index < 74) {
                    $member->group_id = $group_ids[0];
                }

                if ($index >= 74 && $index < 148) {
                    $member->group_id = $group_ids[1];
                }

                if ($index >= 148) {
                    $member->group_id = $group_ids[2];
                }

            });

        // 将数据集合转换为数组，并插入到数据库中
        \App\Member::query()->insert($members->toArray());
    }
}
