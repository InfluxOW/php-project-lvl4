<?php

namespace App\Http\Middleware;

use Closure;

class TransformFiltrationRequestData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
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
                return redirect()->route('tasks.index', $outcomingQuery->toArray());
            }
        }
        return $next($request);
    }
}
