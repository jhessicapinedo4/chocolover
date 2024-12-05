<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
  public function handle($request, Closure $next, ...$roles)
  {
    if (!Auth::check()) {
      return redirect('/login'); //aca es lo que debo modificar 
    }

    if (!in_array(Auth::user()->role, $roles)) {
      return redirect(
        Auth::user()->role === 'admin' ? '/admin' : '/'
      );
    }

    return $next($request);


    
  }


}
