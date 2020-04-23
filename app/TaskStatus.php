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
        return $this->hasMany('App\Task');
    }

    //Scopes

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    //Boot

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($status) {
            Task::whereHas('status', function ($query) use ($status) {
                $query->where('id', $status->id);
            })
            ->get()
            ->each(function ($task) {
                $task->status()->associate(TaskStatus::where('name', 'new')->first());
                $task->save();
            });
        });
    }
}
