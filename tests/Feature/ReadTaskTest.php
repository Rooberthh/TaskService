<?php

    use App\Status;
    use Laravel\Lumen\Testing\DatabaseMigrations;

    class ReadTaskTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function a_user_can_fetch_tasks ()
        {
            $task = create('App\Task');

            $this->json('get', 'api/tasks')
                ->seeJsonContains($task->toArray())
                ->assertResponseStatus(200);
        }
    }
