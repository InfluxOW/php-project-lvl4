<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use tizis\laraComments\Contracts\ICommentable;
use tizis\laraComments\Traits\Commentable;

class Task extends Model implements ICommentable
{
    use SoftDeletes;
    use Commentable;

    protected $fillable = ['name', 'description', 'status_id', 'assignees', 'labels'];

    //Relations

    public function status()
    {
        return $this->belongsTo('App\TaskStatus');
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id');
    }

    public function assignees()
    {
        return $this->belongsToMany('App\User', 'task_assignee', 'task_id', 'assignee_id')->withTimestamps();
    }

    public function labels()
    {
        return $this->belongsToMany('App\Label')->withTimestamps();
    }

    //Scopes

    public function scopeCompletedTasks(Builder $query)
    {
        return $query->whereHas('status', function ($query) {
            return $query->where('name', 'completed');
        });
    }
}
