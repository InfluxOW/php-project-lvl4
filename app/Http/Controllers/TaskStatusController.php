<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStatusValidation as StatusValidation;
use App\TaskStatus as Status;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'create', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::latest()->paginate(5);

        return view('task_statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(Status::class);

        $task_status = new Status();

        return view('task_statuses.create', compact('task_status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatusValidation $request)
    {
        $this->authorize(Status::class);

        $validatedData = $request->validated();
        $task_status = Status::create($validatedData);

        flash("Status \"$task_status->name\" was created successfully!")->success()->important();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $task_status)
    {
        $this->authorize($task_status);

        return view('task_statuses.edit', compact('task_status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(StatusValidation $request, Status $task_status)
    {
        $this->authorize($task_status);

        $validatedData = $request->validated();
        $task_status->update($validatedData);

        flash("Status \"$task_status->name\" was updated successfully!")->success()->important();

        return redirect()->route('task_statuses.index', $task_status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $task_status)
    {
        $this->authorize($task_status);

        $task_status->delete();

        flash("Status \"$task_status->name\" was deleted successfully!")->success()->important();

        return redirect()->route('task_statuses.index');
    }
}