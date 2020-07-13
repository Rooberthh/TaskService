<?php


    use Illuminate\Http\Request;
    use Laravel\Lumen\Testing\DatabaseMigrations;

    class MiddlewareTest extends TestCase
    {
        use DatabaseMigrations;


        /** @test
        function requests_is_checked_for_api_key_on_production()
        {
            $board = make('App\Board');

            $this->json('post', $board->path(), $board->toArray())
                ->assertResponseStatus(403);
        }
         *
         TODO:: Fix test logic by making all requests use apikey?
         */
    }