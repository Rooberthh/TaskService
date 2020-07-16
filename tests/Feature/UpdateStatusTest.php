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

        /** @test */
        function a_user_can_update_the_order_of_a_status()
        {
            $status = create('App\Status', ['order' => 100]);

            $this->json('patch', $status->path(), ['order' => 1, 'name' => "hello", "color" => "#111222"])
                ->assertResponseStatus(200);

            $this->assertEquals(1, $status->fresh()->order);
        }

        /** @test */
        function a_status_orders_can_be_updated()
        {
            $status = create('App\Status', ['order' => 100]);

            $this->json('patch', $status->board->path(), $status->toArray())
                ->assertResponseStatus(200);
        }
    }
