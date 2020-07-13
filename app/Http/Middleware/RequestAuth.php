<?php

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\Response;

    class RequestAuth
    {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @return mixed
         */
        public function handle($request, Closure $next)
        {
            $response = $next($request);
            if(app()->environment('production')) {
                if ($response->headers->get('X-api-key') === null || $response->headers->get('X-api-key') !== config('api.key')) {
                    return new Response('Bad or no key', 403);
                }
            }

            return $response;
        }
    }
