<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Driverdevices;
use App\Mastersettings;
use App\Vendors;

class ManageAuthentication {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin') {
        if (!Auth::guard($guard)->check()) {            
            //redirec to dashboard
            return redirect('/manage/login');
        }
        return $next($request);
    }

}
