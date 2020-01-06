<?php

    use App\Status;
    use Laravel\Lumen\Testing\DatabaseMigrations;

    class UpdateStatusTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function a_user_can_update_a_status()
        {
            $status = create('App\Status');

            $this->json('patch', $status->path(), ['name' => 'is changed', 'color' => $status->color])
                ->assertResponseStatus(200);

            $this->assertEquals('is changed', $status->fresh()->name);
        }
    }
