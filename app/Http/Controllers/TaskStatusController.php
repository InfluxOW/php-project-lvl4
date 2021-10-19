<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStatusRequest;
use App\TaskStatus as Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'create', 'edit', 'update', 'destroy']);
    }

    public function index(): View
    {
        $statuses = Status::latest()->paginate(10);

        return view('task_statuses.index', compact('statuses'));
    }

    public function create(): View
    {
        $this->authorize(Status::class);

        $status = new Status();

        return view('task_statuses.create', compact('status'));
    }

    public function store(TaskStatusRequest $request): RedirectResponse
    {
        $this->authorize(Status::class);

        $status = Status::create($request->all());

        flash(__('status_created', ['status' => $status->name]))->success()->important();

        return redirect()->route('task_statuses.index');
    }

    public function edit(Status $status): View
    {
        $this->authorize($status);

        return view('task_statuses.edit', compact('status'));
    }

    public function update(TaskStatusRequest $request, Status $status): RedirectResponse
    {
        $this->authorize($status);

        $status->update($request->all());

        flash(__('status_updated', ['status' => $status->name]))->success()->important();

        return redirect()->route('task_statuses.index');
    }

    public function destroy(Status $status): RedirectResponse
    {
        $this->authorize($status);

        $status->delete();

        flash(__('status_deleted', ['status' => $status->name]))->success()->important();

        return redirect()->route('task_statuses.index');
    }
}
