<?php

    use App\Status;
    use App\Task;
    use Laravel\Lumen\Testing\DatabaseMigrations;

    class FavoritesTest extends TestCase
    {
        use DatabaseMigrations;

        /** @test */
        function a_user_can_favorite_a_status ()
        {
            $status = create('App\Status');
            $this->json('post', "api/statuses/" . $status->id . "/favorite")
                ->assertResponseStatus(200);

            $this->assertTrue($status->fresh()->isFavorited());
        }

        /** @test */
        function a_user_can_unfavorite_a_status ()
        {
            $status = create('App\Status');

            $status->favorite();

            $this->json('delete', "api/statuses/" . $status->id . '/favorite')
                ->assertResponseStatus(200);

            $this->assertFalse($status->fresh()->isFavorited());
        }
    }
