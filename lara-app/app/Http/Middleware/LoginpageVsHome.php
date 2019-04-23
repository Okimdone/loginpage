<?php

    namespace App\Http\Middleware;

    use Closure;
    use JWTAuth;
    use Exception;
    use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
    use Illuminate\Http\Response;

    class LoginpageVsHome extends BaseMiddleware
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

            try {
                $user = JWTAuth::parseToken()->authenticate();
            } catch (Exception $e) {
                return new Response(view('loginpage'));
            }
            return $next($request);
        }
    }
