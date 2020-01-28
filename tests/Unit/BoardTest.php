<?php

    use App\Status;
    use Laravel\Lumen\Testing\DatabaseMigrations;

    class BoardTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function it_consists_of_statuses ()
        {
            $board = create('App\Board');
            $status = create('App\Status', ['board_id' => $board->id]);

            $this->assertTrue($board->statuses->contains($status));
        }

    }
