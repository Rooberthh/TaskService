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

    use App\Board;
    use App\Objective;
    use App\Status;
    use App\Task;
    use Faker\Generator;

    $factory->define(Task::class, function (Faker\Generator $faker) {
        return [
            'title' => $faker->sentence,
            'description' => $faker->paragraph,
            'order' => $faker->numberBetween(1, 1000),
            'status_id' => function () {
                return factory(Status::class)->create()->id;
            },
        ];
    });

    $factory->state(Task::class, 'from_existing_statuses', function ($faker) {
        $title = $faker->sentence;

        return [
            'status_id' => function () {
                return Status::all()->random()->id;
            },
            'title' => $title,
            'description'  => $faker->paragraph,
        ];
    });

    $factory->define(Board::class, function (Faker\Generator $faker) {
        return [
            'name' => $faker->word,
            'user_id' => 1
        ];
    });

    $factory->define(Status::class, function (Faker\Generator $faker) {
        return [
            'name' => $faker->word,
            'board_id' => function() {
                return factory(Board::class)->create()->id;
            },
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
