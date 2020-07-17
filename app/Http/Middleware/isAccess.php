<?php

namespace App\Http\Middleware;

use Closure;
use App\Providers\RouteServiceProvider;
use Auth;
use App\Models\User;

class isAccess
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
        //If the status is not active redirect to login
        if (Auth::check() && Auth::user()->status === User::ACTIVE_STATUS) {
            return $next($request);

        } else {
            Auth::logout();

            // getMessage('danger', 'Your account has been de-activated, please contact to admin!');
            return redirect('/login')->with('error', 'Your account has been De-activated, please contact to Administrator!');

        }

        


        
    }
}
