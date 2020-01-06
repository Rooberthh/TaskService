<?php

    use App\Status;
    use Laravel\Lumen\Testing\DatabaseMigrations;

    class CreateStatusTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function a_user_can_create_a_status ()
        {
            $status = make('App\Status');

            $this->json('post', 'api/statuses', $status->toArray())
                ->assertResponseStatus(200);

            $this->seeInDatabase('statuses', $status->toArray());
        }

    }
