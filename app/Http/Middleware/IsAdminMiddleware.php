<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class IsAdminMiddleware
{
   /**
    * Handle an incoming request.
    *
    * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    */
   public function handle(Request $request, Closure $next): Response
   {
      if (!auth()->check() || !auth()->user()->is_admin()) {
         Log::info('Unauthorized access attempt', ['user_id' => auth()->id()]);
         return response()->json(['message' => 'Unauthorized'], 401);
      }

      Log::info('Authorized admin access', ['user_id' => auth()->id()]);
      return $next($request);
   }
}
