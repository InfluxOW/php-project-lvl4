<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskValidation;
use App\Status;
use App\Task;
use App\User;
use Illuminate\Http\Request;

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
    public function index()
    {
        $tasks = Task::latest()->with('creator', 'assignees', 'status')->paginate(10);

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

        $user = $request->user();
        $task->creator()->associate($user);

        $status = Status::find($request->status_id);
        $task->status()->associate($status)->save();

        $assignees = collect($request->assignees);
        $assignees->each(function ($assigneeId) use ($task) {
            $user = User::find($assigneeId);
            $task->assignees()->attach($user);
            $task->save();
        });

        flash(__('Task was created successfully!'))->success()->important();

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
        $task->update($validatedData);

        if ($request->status_id != $task->status->id) {
            $status = Status::find($request->status_id);
            $task->status()->associate($status)->save();
        }



        if ($request->assignees != $task->assignees->pluck('id')->toArray()) {
            $task->assignees()->detach();
            $assignees = collect($request->assignees);
            $assignees->each(function ($assigneeId) use ($task) {
                $user = User::find($assigneeId);
                $task->assignees()->attach($user);
                $task->save();
            });
        }

        flash(__('Task was updated successfully!'))->success()->important();

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

        flash(__('Task was deleted successfully!'))->success()->important();

        return redirect()->route('tasks.index');
    }
}
