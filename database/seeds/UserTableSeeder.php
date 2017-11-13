<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        foreach (range(1, 10) as $index) {
            // avatar
            if (env('FAKER_IMAGE_STORAGE', false)) {
                $avatarUrl = $faker->image(storage_path('app/uploads/user/avatar'), 300, 300, 'people');
                $avatarUrl = strstr($avatarUrl, 'uploads/user/avatar');

                $profileBgImgUrl = $faker->image(storage_path('app/uploads/user/profile_bg_img'), 1528, 675);
                $profileBgImgUrl = strstr($profileBgImgUrl, 'uploads/user/profile_bg_img');
            } else {
                $avatarUrl = $faker->imageUrl(300, 300, 'people');
                $profileBgImgUrl = $faker->imageUrl(1528, 675);
            }

            $data[] = [
                'nickname'      =>      $faker->name(),
                'avatar'        =>      $avatarUrl,
                'profile_bg_img'    =>  $profileBgImgUrl,
                'bio'           =>      $faker->sentence(),

                'created_at'    =>      $faker->dateTimeThisMonth(),
                'updated_at'    =>      $faker->dateTimeThisMonth(),
            ];
        }

        \App\User::insert($data);
    }
}
