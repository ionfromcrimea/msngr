<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as BaseResponse;

class EnsureCorrectAPIHeaders
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

// обходим требование джейсона в запросе для возможности запостить файл
//        return $next($request);
//        return new Response(substr($_SERVER['REQUEST_URI'],0,16), 406);
//        substr ( string $string , int $start [, int $length ] ) /api/v1/sendfile
        if(substr($_SERVER['REQUEST_URI'],0,16) == '/api/v1/sendfile')
        {
            return $next($request);
        }

        if($request->headers->get('accept') !== 'application/vnd.api+json')
        {
            return new Response('', 406);
        }
        if($request->headers->has('content-type') || $request->isMethod
            ('POST') || $request->isMethod('PATCH')){
            if($request->header('content-type') !== 'application/vnd.api+json'){
                return $this->addCorrectContentType(new Response('',415));
            }
        }
        return $this->addCorrectContentType($next($request));
    }

    private function addCorrectContentType(BaseResponse $response)
    {
        $response->headers->set('content-type', 'application/vnd.api+json');
        return $response;
    }
}
