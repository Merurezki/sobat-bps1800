<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        // $guards = empty($guards) ? [null] : $guards;

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return redirect(RouteServiceProvider::HOME);
        //     }
        // }

        // return $next($request);

        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->userSobat->role;
         
            $tahun = Carbon::now()->format('Y');
            $bulan = Carbon::now()->format('m');
            
            switch ($role) {
               case '1':
                  return redirect('dashboard/'.$tahun.'/'.$bulan.'');
                  break;
   
               case '2':
                  return redirect('dashboard/'.$tahun.'/'.$bulan.'');
                  break;
   
               case '3':
                  return redirect('dashboard/'.$tahun.'/'.$bulan.'');
                  break;
                  
               case '9':
                  return redirect('dashboard/'.$tahun.'/'.$bulan.'');
                  break; 
      
               default:
                  return route('login'); 
                  break;
            }
         }
         
         return $next($request);
    }
}
