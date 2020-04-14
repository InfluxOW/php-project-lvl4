<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

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
        return $this->belongsToMany('App\User', 'task_assignees', 'task_id', 'assignee_id');
    }
}
