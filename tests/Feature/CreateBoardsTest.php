<?php

    use Laravel\Lumen\Testing\DatabaseMigrations;

    class CreateBoardsTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function a_user_can_create_a_board ()
        {
            $board = make('App\Board');

            $this->json('post', $board->path(), $board->toArray())
                ->assertResponseStatus(200);

            $this->seeInDatabase('boards', $board->toArray());
        }

    }
