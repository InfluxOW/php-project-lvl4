<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['edit', 'update', 'create', 'store', 'destroy']);
    }

    public function index(): View
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

    public function create(): View
    {
        $this->authorize(Task::class);

        $task = new Task();

        return view('tasks.create', compact('task'));
    }

    public function store(TaskRequest $request): RedirectResponse
    {
        $this->authorize(Task::class);

        $task = DB::transaction(function () use ($request): Task {
            $task = $request->user()->createdTasks()->create($request->only(['name', 'description', 'status_id']));
            $task->assignees()->sync($request->assignees);
            $task->labels()->sync($request->labels);

            return $task;
        });

        flash(__('task_created', ['task' => $task->name]))->success()->important();

        return redirect()->route('tasks.show', $task);
    }

    public function show(Task $task): View
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task): View
    {
        $this->authorize($task);

        return view('tasks.edit', compact('task'));
    }

    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        $this->authorize($task);

        $task = DB::transaction(function () use ($request, $task): Task {
            $task->fill($request->only(['name', 'description', 'status_id']));
            $task->save();

            $task->assignees()->sync($request->assignees);
            $task->labels()->sync($request->labels);

            return $task;
        });

        flash(__('task_updated', ['task' => $task->name]))->success()->important();

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize($task);

        $task->delete();

        flash(__('task_deleted', ['task' => $task->name]))->success()->important();

        return redirect()->route('tasks.index');
    }

    public function filter(Request $request): RedirectResponse
    {
        $incomingQuery = $request->query->all();
        $outcomingQuery = collect($incomingQuery)->map(function (array $filters): Collection {
            return collect($filters)
                ->filter(function (array $filterValues): bool {
                    return count(array_filter($filterValues)) > 0;
                })
                ->map(function (array $filterValues): string {
                    return implode(',', $filterValues);
                });
        });

        return redirect()->route('tasks.index', $outcomingQuery->toArray());
    }
}
