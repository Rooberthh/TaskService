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

        /** @test */
        function tasks_are_fetched_by_order ()
        {
            $status = create('App\Status');
            create('App\Task', ['status_id' => $status->id, 'order' => 10]);
            create('App\Task', ['status_id' => $status->id, 'order' => 9]);

            $response = $this->json('get', "api/statuses/$status->id/tasks")->response->getContent();

            $tasks = json_decode($response);

            $this->assertEquals(9, $tasks[0]->order);
        }
    }
