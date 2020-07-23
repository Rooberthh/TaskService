<?php

    use Laravel\Lumen\Testing\DatabaseMigrations;

    class UpdateBoardTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function a_user_can_update_a_board ()
        {
            $board = create('App\Board');

            $this->json('patch', $board->path(), ['name' => 'is changed', 'user_id' => 1])
                ->assertResponseStatus(200);

            $this->assertEquals('is changed', $board->fresh()->name);
        }

        /** @test */
        function a_unauthenticated_user_cant_update_a_board ()
        {
            $board = create('App\Board', ['user_id' => 2]);

            $this->json('patch', $board->path(), ['name' => 'is changed', 'user_id' => 1])
                ->assertResponseStatus(403);
        }

    }
