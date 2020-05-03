<?php

    use App\Status;
    use Laravel\Lumen\Testing\DatabaseMigrations;

    class ReadTaskTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function a_user_can_fetch_tasks ()
        {
            $status = create('App\Status');
            create('App\Task', ['status_id' => $status->id]);

            $this->json('get', "api/statuses/$status->id/tasks")
                ->assertResponseStatus(200);
        }
    }
