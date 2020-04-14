<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use App\BlogPost;
use App\Status;
use App\User;

class Filtration
{
    public function compose(View $view)
    {
        $statuses = Status::all()->pluck('name', 'id');
        $assignees = User::assignees()->pluck('name', 'id');
        $creators = User::creators()->pluck('name', 'id');
        $users = User::pluck('name', 'id');

        $view->with('statuses', $statuses);
        $view->with('assignees', $assignees);
        $view->with('creators', $creators);
        $view->with('users', $users);
    }
}
