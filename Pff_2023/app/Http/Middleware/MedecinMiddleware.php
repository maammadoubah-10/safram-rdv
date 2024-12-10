<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MedecinMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  // app/Http/Middleware/MedecinMiddleware.php


  public function handle($request, Closure $next)
  {
      if (auth()->check() && auth()->user()->isMedecin()) {
          return $next($request);
      }

      return redirect()->route('home'); // Redirigez l'utilisateur s'il n'est pas authentifié en tant que médecin
  }


}
