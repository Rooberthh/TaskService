<?php

    use App\Board;
    use App\Status;
    use Laravel\Lumen\Testing\DatabaseMigrations;

    class StatusTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function it_consists_of_tasks ()
        {
            $status = create('App\Status');
            $task = create('App\Task', ['status_id' => $status->id]);

            $this->assertTrue($status->tasks->contains($task));
        }

        /** @test */
        function it_belongs_to_a_board()
        {
            $status = create('App\Status');

            $this->assertInstanceOf(Board::class, $status->board);
        }
    }
