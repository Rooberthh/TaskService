<?php

    use App\Objective;
    use App\Status;
    use App\Task;
    use Laravel\Lumen\Testing\DatabaseMigrations;

    class CreateTaskTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function a_user_can_create_a_task ()
        {
            $status = create('App\Status');
            $task = make('App\Task', ['status_id' => $status->id]);

            $this->json('post', $status->path() . '/tasks', $task->toArray())
                ->assertResponseStatus(200);

            $this->seeInDatabase('tasks', $task->toArray());
        }

        /** @test */
        function a_task_title_must_be_unique()
        {
            $status = create('App\Status');

            create('App\Task', ['title' => 'created', 'status_id' => $status->id]);
            $task = make('App\Task', ['title' => 'created', 'status_id' => $status->id]);

            $response = $this->json('post', $task->status->path() . '/tasks', $task->toArray());

            $this->assertEquals(422, $response->response->getStatusCode());
            // $this->notSeeInDatabase('tasks', $task->toArray());
        }

        /** @test */
        function a_user_can_delete_a_task()
        {
            $task = create('App\Task');

            $this->json('delete', $task->path())
                ->assertResponseStatus(200);

            // $this->notSeeInDatabase('tasks', $task->toArray());
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
