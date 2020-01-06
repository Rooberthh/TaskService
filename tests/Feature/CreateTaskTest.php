<?php

    use App\Status;
    use Laravel\Lumen\Testing\DatabaseMigrations;

    class CreateTaskTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function a_user_can_create_a_task ()
        {
            $task = make('App\Task', ['status_id' => 0]);

            $this->json('post', 'api/tasks', $task->toArray())
                ->assertResponseStatus(200);

            $this->seeInDatabase('tasks', $task->toArray());
        }
    }
