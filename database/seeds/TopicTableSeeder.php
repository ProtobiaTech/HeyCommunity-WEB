<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = \App\User::pluck('id')->toArray();
        $topicNodes = \App\TopicNode::pluck('id')->toArray();

        foreach (range(1, 128) as $index) {
            $data[] = [
                'user_id'       =>      $faker->randomElement($users),
                'node_id'       =>      $faker->randomElement($topicNodes),
                'title'         =>      $faker->sentence(6),
                'content'       =>      implode('', $faker->paragraphs(random_int(4, 9))),

                'created_at'    =>  $faker->dateTimeThisMonth(),
                'updated_at'    =>  $faker->dateTimeThisMonth(),
            ];
        }

        \App\Topic::insert($data);
    }
}
