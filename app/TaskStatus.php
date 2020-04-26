<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskStatus extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    public const DEFAULT_STATUSES = [
        'new', 'testing', 'processing', 'completed'
    ];

    //Relations

    public function tasks()
    {
        return $this->hasMany('App\Task', 'status_id');
    }

    //Scopes

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }
}
