<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use App\BlogPost;
use App\Label;
use App\TaskStatus;
use App\User;

class Filtration
{
    public function compose(View $view)
    {
        $statuses = TaskStatus::pluck('name', 'id');
        $assignees = User::assignees()->pluck('name', 'id');
        $creators = User::creators()->pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');

        // if (!Status::where('name', 'new')->first()) {
        //     Status::create(['name' => 'new']);
        // }
        $statusNew = TaskStatus::where('name', 'new')->pluck('id');

        if (request()->has('filter')) {
            $query = request()->query->all()['filter'];
        } else {
            $query = null;
        }

        $view->with('statuses', $statuses);
        $view->with('assignees', $assignees);
        $view->with('creators', $creators);
        $view->with('users', $users);
        $view->with('statusNew', $statusNew);
        $view->with('labels', $labels);
        $view->with('query', $query);
    }
}
