<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkDobField
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return RedirectResponse|mixed|Response
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if ($request->user() && $request->user()->profile->dob === null && route('users.dob') !== $request->url() && route('users.settings.update') !== $request->url()) {
            return redirect()->route('users.dob')->withErrors('dateofbirth', 'Please fill in your date of birth before continuing.');
        }

        return $next($request);
    }
}
