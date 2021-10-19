<?php

namespace App\Http\ViewComposers;

use App\Enums\TaskStatus;
use Illuminate\View\View;
use App\BlogPost;
use App\Label;
use App\TaskStatus as Status;
use App\User;

class Filtration
{
    public function compose(View $view)
    {
        $statuses = Status::pluck('name', 'id');
        $assignees = User::assignee()->pluck('name', 'id');
        $creators = User::creator()->pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');

        $statusNew = Status::where('name', TaskStatus::NEW)->pluck('id');
        $query = request()->has('filter') ? request()->query->all()['filter'] : null;

        $view->with('statuses', $statuses);
        $view->with('assignees', $assignees);
        $view->with('creators', $creators);
        $view->with('users', $users);
        $view->with('statusNew', $statusNew);
        $view->with('labels', $labels);
        $view->with('query', $query);
    }
}
