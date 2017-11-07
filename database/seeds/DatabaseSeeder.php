<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(ActivityTableSeeder::class);
        $this->call(TopicNodeTableSeeder::class);
        $this->call(TopicTableSeeder::class);
    }
}
