<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskFiltrationController extends Controller
{
    public function index(Request $request)
    {
        // $incomingQuery contains collection of the query string elements
        $incomingQuery = collect($request->query->all());
        // We're iterating over collection items and transforming nested arrays to strings
        $outcomingQuery = $incomingQuery->map(function ($item) {
            return collect($item)->map(function ($item) {
                return implode(',', $item);
            });
        });

        return redirect()->route('tasks.index', $outcomingQuery->toArray());
    }
}
