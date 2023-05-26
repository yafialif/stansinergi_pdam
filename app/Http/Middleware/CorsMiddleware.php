<?php

use Illuminate\Http\Response;

class CorsMiddleware
{
    public function handle($request, Closure $next)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Origin, Content-Type, Authorization");

        if ($request->getMethod() === "OPTIONS") {
            return Response::make("OK", 200, [
                "Access-Control-Allow-Methods" => "GET, POST, PUT, DELETE, OPTIONS",
                "Access-Control-Allow-Headers" => "Origin, Content-Type, Authorization"
            ]);
        }

        return $next($request);
    }
}
