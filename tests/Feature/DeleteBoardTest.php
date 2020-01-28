<?php

    use App\Status;
    use App\Task;
    use Laravel\Lumen\Testing\DatabaseMigrations;

    class DeleteBoardTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function a_user_can_delete_a_board ()
        {
            $board = create('App\Board');

            $this->json('delete', $board->path())
                ->assertResponseStatus(200);

            $this->notSeeInDatabase('boards', $board->toArray());
        }

        /** @test */
        function when_a_board_is_deleted_its_corresponding_statuses_are_deleted()
        {
            $board = create('App\Board');
            create('App\Status', ['board_id' => $board->id], 10);

            $this->assertCount(10, Status::all());

            $board->delete();

            $this->assertCount(0, Status::all());
        }

    }
