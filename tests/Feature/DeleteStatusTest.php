<?php

    use App\Status;
    use App\Task;
    use Laravel\Lumen\Testing\DatabaseMigrations;

    class DeleteStatusTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function a_user_can_delete_a_status ()
        {
            $status = create('App\Status');

            $this->json('delete', $status->path())
                ->assertResponseStatus(200);

            $this->notSeeInDatabase('statuses', $status->toArray());
        }

        /** @test */
        function when_a_status_is_deleted_its_corresponding_tasks_are_deleted()
        {
            $status = create('App\Status');
            create('App\Task', ['status_id' => $status->id], 10);

            $this->assertCount(10, Task::all());

            $status->delete();

            $this->assertCount(0, Task::all());
        }

    }
