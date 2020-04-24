<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransformFiltrationRequestData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('filter')) {
            $incomingQuery = $request->query->all();
            $implodable = collect($incomingQuery['filter'])->every(function ($value) {
                return is_array($value);
            });
            if ($implodable) {
                $outcomingQuery = collect($incomingQuery)->map(function ($item) {
                    return collect($item)->map(function ($item) {
                        return implode(',', $item);
                    });
                });
                $queryString = $outcomingQuery->toArray();
                return redirect()->route('tasks.index', $queryString);
            }
        }
        return $next($request);
    }
}
