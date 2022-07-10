<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $password = Hash::make('sajid');

        User::create(
            [
                         'name' => 'Administrator',
                         'email' => 'admin@test.com',
                         'password' => $password,
                     ]
        );

        for ($i = 0; $i < 5; $i++) {
            User::create(
                [
                    'name' => $faker->name,
                    'email' => $faker->email,
                    'password' => $password,
                ]
            );
        }
    }
}
