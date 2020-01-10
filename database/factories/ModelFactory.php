<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

    use App\Objective;
    use App\Status;
    use App\Task;
    use Faker\Generator;

    $factory->define(Task::class, function (Faker\Generator $faker) {
        return [
            'title' => $faker->sentence,
            'description' => $faker->paragraph,
            'status_id' => function () {
                return factory(Status::class)->create()->id;
            },
        ];
    });

    $factory->define(Status::class, function (Faker\Generator $faker) {
        return [
            'name' => $faker->word,
            'color' => '#333',
        ];
    });

    $factory->define(Objective::class, function (Faker\Generator $faker) {
        return [
            'task_id' => function () {
                return factory(Task::class)->create()->id;
            },
            'body' => $faker->paragraph,
            'completed' => false
        ];
    });
