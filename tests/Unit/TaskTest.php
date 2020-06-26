<?php

    use App\Status;
    use Carbon\Carbon;
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
        function it_can_have_objectives()
        {
            $task = create('App\Task');
            $objective = $task->addObjective('New objective');

            $this->assertCount(1, $task->objectives);
            $this->assertTrue($task->fresh()->objectives->contains($objective));
        }

        /** @test */
        function it_is_fetched_in_order()
        {
            $status = create('App\Status');
            $first = create('App\Task', ['status_id' => $status->id, 'order' => 10, 'updated_at' => Carbon::now()]);
            $second = create('App\Task', ['status_id' => $status->id, 'order' => 10, 'updated_at' => Carbon::now()->subHour()]);
            create('App\Task', ['status_id' => $status->id, 'order' => 10, 'updated_at' => Carbon::now()->subMonth()]);

            $this->assertEquals($status->tasks->first()->title, $first->title);
            $this->assertEquals($status->tasks[1]->title, $second->title);
        }
    }
