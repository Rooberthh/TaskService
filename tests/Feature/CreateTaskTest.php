<?php

    use App\Objective;
    use App\Status;
    use Laravel\Lumen\Testing\DatabaseMigrations;

    class CreateTaskTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function a_user_can_create_a_task ()
        {
            $task = make('App\Task', ['status_id' => 0]);

            $this->json('post', 'api/tasks', $task->toArray())
                ->assertResponseStatus(200);

            $this->seeInDatabase('tasks', $task->toArray());
        }

        /** @test */
        function a_user_can_delete_a_task()
        {
            $task = create('App\Task');

            $this->json('delete', $task->path())
                ->assertResponseStatus(200);

            $this->notSeeInDatabase('tasks', $task->toArray());
        }

        /** @test */
        function when_a_task_is_deleted_its_corresponding_objectives_are_deleted()
        {
            $task = create('App\Task');
            create('App\Objective', ['task_id' => $task->id], 10);

            $this->assertCount(10, Objective::all());
            $task->delete();
            $this->assertCount(0, Objective::all());
        }
    }
