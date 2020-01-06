<?php

    use App\Status;
    use Laravel\Lumen\Testing\DatabaseMigrations;

    class TaskObjectivesTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function an_objective_can_be_added_to_a_task()
        {
            $objective = make('App\Objective', ['body' => 'new objective']);

            $this->json('post', $objective->task->path() . '/objectives', $objective->toArray())
                ->assertResponseStatus(200);

            $this->seeInDatabase('objectives', ['body' => 'new objective']);
        }
    }
