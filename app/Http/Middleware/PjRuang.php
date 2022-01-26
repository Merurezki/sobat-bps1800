<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\PjRuang as Middleware;
use Illuminate\Support\Facades\Auth;

class PjRuang {

  public function handle($request, Closure $next, String $pj_ruang) {
    if (!Auth::check()) // This isnt necessary, it should be part of your 'auth' middleware
      return redirect('login');

    $user = Auth::user()->userSobat->pj_ruang;
    if($user == $pj_ruang)
      return $next($request);

    return redirect('login');
  }
}