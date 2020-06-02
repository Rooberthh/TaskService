<?php

    use App\Status;
    use Laravel\Lumen\Testing\DatabaseMigrations;

    class UpdateTaskTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function a_user_can_update_a_task ()
        {
            $task = create('App\Task');

            $this->json('patch', $task->path(), [
                'title' => 'is changed',
                'status_id' => $task->status->id
                ])
                ->assertResponseStatus(200);

            $this->assertEquals('is changed', $task->fresh()->title);
        }

        /** @test */
        function a_user_can_update_the_order_of_a_task ()
        {
            $task = create('App\Task');

            $this->json('patch', $task->path(), [
                'title' => 'is changed',
                'status_id' => $task->status->id,
                'order' => 1
            ])
                ->assertResponseStatus(200);

            $this->assertEquals(1, $task->fresh()->order);

            $this->json('patch', $task->path(), [
                'title' => 'is changed',
                'status_id' => $task->status->id,
            ])
                ->assertResponseStatus(200);

            $this->assertEquals(1, $task->fresh()->order);
        }
    }
