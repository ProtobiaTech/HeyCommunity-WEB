<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ActivityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        foreach (range(1, 20) as $index) {
            // avatar
            if (env('FAKER_IMAGE_STORAGE', false)) {
                $avatarUrl = $faker->image(storage_path('app/uploads/activity'), 500, 300, 'fashion');
                $avatarUrl = strstr($avatarUrl, 'uploads/activity');
            } else {
                $avatarUrl = $faker->imageUrl(500, 300, 'fashion');
            }

            $data[] = [
                'title'         =>      $faker->sentence(),
                'avatar'        =>      $avatarUrl,
                'intro'         =>      $faker->text(100),
                'content'       =>      $faker->text(400),

                'created_at'    =>      $faker->dateTimeThisMonth(),
                'updated_at'    =>      $faker->dateTimeThisMonth(),
            ];
        }

        \App\Activity::insert($data);
    }
}
