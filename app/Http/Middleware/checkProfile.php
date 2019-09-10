<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkProfile
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
        if(!Auth::user()->completed){
            toastr()->info("please , complete your profile to use our website","Complete Profile",['timeOut'=>50000]);
            return redirect('/user/settings/profile/edit');
        }
            // return redirect('/login');
        // }else if(!Auth::user()->approved) {
        //         Auth::logout();
        //      toastr()->error('Sorry, your account not approved by admin yet.',"Permition",['timeOut'=>15000]);
        //     return redirect('/login');
        // }
        return $next($request);
    }
}
