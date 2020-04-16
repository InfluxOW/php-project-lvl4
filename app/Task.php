<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use tizis\laraComments\Contracts\ICommentable;
use tizis\laraComments\Traits\Commentable;

class Task extends Model implements ICommentable
{
    use SoftDeletes;
    use Commentable;

    protected $fillable = ['name', 'description', 'status_id', 'creator_id'];

    //Relations

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id', 'id');
    }

    public function assignees()
    {
        return $this->belongsToMany('App\User', 'task_assignees', 'task_id', 'assignee_id')->withTimestamps();
    }

    public function labels()
    {
        return $this->belongsToMany('App\Label')->withTimestamps();
    }
}
