<?php

namespace Tests;

use Database\Seeders\DatabaseSeeder;
use Database\Seeders\UsersTableSeeder;
use Faker\Generator;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Faker\Factory;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected Generator $faker;

    public function setUp(): void {
        parent::setUp();
        $this->faker = Factory::create();
        Artisan::call('migrate:refresh');
        (new DatabaseSeeder())->call(UsersTableSeeder::class);
    }


}
