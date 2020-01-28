<?php

    use App\Status;
    use Laravel\Lumen\Testing\DatabaseMigrations;

    class CreateStatusTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function a_user_can_create_a_status ()
        {
            $board = create('App\Board');

            $status = make('App\Status', ['board_id' => $board->id]);

            $this->json('post', $board->path() . '/statuses', $status->toArray())
                ->assertResponseStatus(200);

            $this->seeInDatabase('statuses', $status->toArray());
        }

    }
