<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodosTableSeeder extends Seeder
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
            Todo::create(
                [
                    'user_id' => User::all()->random()->id,
                    'title' => $faker->sentence,
                    'status' => 'pending',
                    'due_on' => $faker->date,
                ]
            );
        }
    }
}
