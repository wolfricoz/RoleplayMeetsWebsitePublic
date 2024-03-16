<?php

namespace App\Http\Middleware;

use Closure;
use Cog\Laravel\Ban\Models\Ban;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfBanned
{
  /**
   * Handle an incoming request.
   *
   * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
   */
  public function handle(Request $request, Closure $next): Response
  {
//    dd($request->user());
    if (!$request->user()) {
      return $next($request);
    }
    if ($request->user()->hasRole('admin')) {
      return $next($request);
    }
    if ($request->user()->isBanned()) {
      $reason = $request->user()->getBans()->first()->comment ?? 'No reason found';
      $expired_at = optional($request->user()->getBans()->first()->expired_at)->format('d/m/y H:i') ?? 'Permanent';
      auth()->logout();
      return redirect()->route('home')->with('error', "Your account has been banned with the reason: {$reason}, it expires at: {$expired_at}. If you think this is incorrect, please contact an admin.");
    }
//    $bans = Ban::withTrashed()->where('bannable_id', $request->user()->id)->first();
//    if ($bans) {
//      $reason = $request->user()->getBans()->first()->comment ?? 'No reason found';
//      $expired_at = $request->user()->getBans()->first()->expired_at ?? 'Permanent';
//      auth()->logout();
//      return redirect()->route('home')->with('error', "Your account has been banned with the reason: {$reason}, please contact an admin.");
//
//
//    }

    return $next($request);
  }
}
