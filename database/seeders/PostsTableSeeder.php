<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 5; $i++) {
            Post::create(
                [
                    'user_id' => User::all()->random()->id,
                    'title' => $faker->sentence,
                    'body' => $faker->paragraph,
                ]
            );
        }
    }
}
