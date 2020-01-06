<?php

    use App\Status;
    use Laravel\Lumen\Testing\DatabaseMigrations;

    class TaskTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function it_can_have_a_status()
        {
            $task = create('App\Task');

            $this->assertInstanceOf(Status::class, $task->status);
        }

        /** @test */
        function it_can_have_objectives ()
        {
            $task = create('App\Task');
            $objective = create('App\Objective', ['task_id' => $task->id]);

            $this->assertTrue($task->objectives->contains($objective));
        }
    }
