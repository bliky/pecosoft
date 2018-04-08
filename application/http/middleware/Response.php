<?php

namespace app\http\middleware;

class Response
{
    public function handle($request, \Closure $next)
    {
    	$response = $next($request);

        //$response->data(['code'=>600]);
        return $response;
    }
}
