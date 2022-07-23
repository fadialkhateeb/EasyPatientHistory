<?php

namespace App\Http\Middleware;

use app\Traits\GeneralTrait;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\facades\JWTAuth;

class apiAuth
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user =null;
        try
        {
            $user  = JWTAuth::parseToken()->authenticate();
        }
        catch(\Exception $e)
        {
           return $this->returnError(401,"user not authenticate");
        }
         if (!$user)
            return $this->returnError(401,"user not authenticate");
        return $next($request);
    }
}
