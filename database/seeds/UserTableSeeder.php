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
        $defaultUser = [
            'nickname'      =>      'HC',
            'bio'           =>      $faker->sentence(),
            'gender'        =>      1,
            'phone'         =>      '12312341234',
            'email'         =>      $faker->email(),
            'password'      =>      Hash::make('hey community'),

            'created_at'    =>      $faker->dateTimeThisMonth(),
            'updated_at'    =>      $faker->dateTimeThisMonth(),
        ];
        \App\User::insert($defaultUser);


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
                'gender'        =>      1,
                'bio'           =>      $faker->sentence(),
                'phone'         =>      $faker->phoneNumber(),
                'email'         =>      $faker->email(),
                'profile_bg_img'    =>  $profileBgImgUrl,
                'password'      =>      Hash::make('hey community'),

                'created_at'    =>      $faker->dateTimeThisMonth(),
                'updated_at'    =>      $faker->dateTimeThisMonth(),
            ];
        }

        \App\User::insert($data);
    }
}
