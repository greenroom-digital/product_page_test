<?php

namespace App\Http\Middleware;

use App\Exceptions\InvalidProductException;
use Closure;
use Illuminate\Http\Request;

class CheckProductSlug
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if Slug is valid
        $url = $request->url();
        $explode = explode('/', $url);
        $end = end($explode);

        $slug = strtok($end, '?'); // remove query params

        if ($slug != 'fall-limited-edition-sneakers') {
            throw new InvalidProductException;
        }

        return $next($request);
    }
}
