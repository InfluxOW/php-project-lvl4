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

        $task = $request->user()->createdTasks()->create($request->only(['name', 'description', 'status_id']));
        $task->save();

        $task->assignees()->sync($request->assignees);
        $task->labels()->sync($request->labels);

        flash(__("Task was created successfully!"))->success()->important();

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

        $task->fill($request->only(['name', 'description', 'status_id']));
        $task->save();

        $task->assignees()->sync($request->assignees);
        $task->labels()->sync($request->labels);

        flash(__("Task was updated successfully!"))->success()->important();

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

        flash(__("Task was deleted successfully!"))->success()->important();

        return redirect()->route('tasks.index');
    }
}
