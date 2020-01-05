<?php

    use App\Status;
    use Laravel\Lumen\Testing\DatabaseMigrations;

    class TaskTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function a_task_can_have_a_status()
        {
            $task = create('App\Task');
            
            $this->assertInstanceOf(Status::class, $task->status);
        }
    }
