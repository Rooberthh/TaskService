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
            $task = create('App\Task');

            $this->json('post', "api/tasks/{$task->id}/objectives", $objective->toArray())
                ->assertResponseStatus(200);

            $this->seeInDatabase('objectives', ['body' => 'new objective']);
        }

        /** @test */
        function an_objective_can_be_deleted()
        {
            $objective = create('App\Objective', ['body' => 'deleted objective']);

            $this->json('delete', $objective->path())
                ->assertResponseStatus(200);

            $this->notseeInDatabase('objectives', ['body' => 'deleted objective']);
        }

        /** @test */
        function an_objective_can_be_updated()
        {
            $objective = create('App\Objective');

            $this->json('patch', $objective->path(), ['body' => 'updated', 'completed' => true])
                ->assertResponseStatus(201);

            $this->seeInDatabase('objectives', [
                'body' => 'updated',
                'completed' => true
            ]);
        }
    }
