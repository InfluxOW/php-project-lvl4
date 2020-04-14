<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

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

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($status) {
            Task::whereHas('status', function ($query) use ($status) {
                $query->where('id', $status->id);
            })->delete();
        });
    }
}
