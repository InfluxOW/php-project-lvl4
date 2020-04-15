<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskFiltrationController extends Controller
{
    public function index(Request $request)
    {
        $incomingQuery = collect($request->query->all());
        $outcomingQuery = $incomingQuery->map(function ($item) {
            return collect($item)->map(function ($item, $key) {
                return implode(',', $item);
            })->toArray();
        })->toArray();

        return redirect()->route('tasks.index', $outcomingQuery);
    }
}
