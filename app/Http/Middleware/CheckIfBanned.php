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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->isBanned()) {
            auth()->logout();
            return redirect()->route('home')->with('error', 'Your account has been banned, please contact an admin.');
        }
        if ($request->user()) {
            $bans = Ban::withTrashed()->where('bannable_id', $request->user()->id)->first();
            if ($bans) {
                auth()->logout();
                return redirect()->route('home')->with('error', 'Your account has been banned, please contact an admin.');

            }

        }

        return $next($request);
    }
}
