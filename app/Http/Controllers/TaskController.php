<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskValidation;
use App\TaskStatus as Status;
use App\Task;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['edit', 'update', 'create', 'store', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = QueryBuilder::for(Task::class)
            ->latest()
            ->with('creator', 'assignees', 'status', 'labels')
            ->allowedFilters([
                AllowedFilter::exact('creator_id'),
                AllowedFilter::exact('status.id'),
                AllowedFilter::exact('assignees.id'),
                AllowedFilter::exact('labels.id')
            ])
            ->paginate(10)
            ->appends(request()->query());

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(Task::class);

        $task = new Task();

        return view('tasks.create', compact('task'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskValidation $request)
    {
        $this->authorize(Task::class);

        $validatedData = $request->validated();
        $task = Task::make($validatedData);

        $task->creator()->associate($request->user());
        $task->status()->associate($request->status_id);
        $task->save();

        $task->assignees()->sync($request->assignees);
        $task->labels()->sync($request->labels);

        flash("Task \"$task->name\" was created successfully!")->success()->important();

        return redirect()->route('tasks.show', $task);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $this->authorize($task);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskValidation $request, Task $task)
    {
        $this->authorize($task);

        $validatedData = $request->validated();
        $task->fill($validatedData);
        $task->status()->associate($request->status_id);
        $task->save();

        $task->assignees()->sync($request->assignees);
        $task->labels()->sync($request->labels);

        flash("Task \"$task->name\" was updated successfully!")->success()->important();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $this->authorize($task);

        $task->delete();

        flash("Task \"$task->name\" was deleted successfully!")->success()->important();

        return redirect()->route('tasks.index');
    }

    public function filtration(Request $request)
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
