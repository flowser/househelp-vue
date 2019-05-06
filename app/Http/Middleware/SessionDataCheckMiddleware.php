<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class SessionDataCheckMiddleware
{

    /**
     * Check session data, if role is not valid logout the request
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $bag = Session::getMetadataBag();

        $max = config('session.lifetime') * 60; // min to hours conversion

        if (($bag && $max < (time() - $bag->getLastUsed()))) {

            $request->session()->flush(); // remove all the session data

            Auth::logout(); // logout user

        }

        return $next($request);
    }

}
