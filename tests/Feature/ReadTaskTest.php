<?php

    use App\Status;
    use Laravel\Lumen\Testing\DatabaseMigrations;

    class ReadTaskTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function a_user_can_fetch_tasks ()
        {
            create('App\Task');

            $this->json('get', 'api/tasks')
                ->seeJsonStructure([
                    '*' => [
                        'title',
                        'status_id'
                    ]
                ])
                ->assertResponseStatus(200);
        }
    }
