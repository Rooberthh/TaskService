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
            if(app()->environment('production')) {
                if ($request->headers->get('auth') === null || $request->headers->get('auth') !== config('api.key')) {
                    return new Response('Bad or no key', 403);
                }
            }

            return $next($request);
        }
    }
