<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use tizis\laraComments\Traits\Commenter;

class User extends Authenticatable
{
    use Notifiable;
    use Commenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relations

    public function createdTasks()
    {
        return $this->hasMany('App\Task', 'creator_id');
    }

    public function assignedTasks()
    {
        return $this->belongsToMany('App\Task', 'task_assignees', 'assignee_id', 'task_id');
    }

    //Scopes

    public function scopeAssignees(Builder $query)
    {
        return $query->whereHas('assignedTasks');
    }

    public function scopeCreators(Builder $query)
    {
        return $query->whereHas('createdTasks');
    }
}
