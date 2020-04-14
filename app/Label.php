<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    public const ATTENTION_LEVEL = [
        5 => 'danger',
        4 => 'warning',
        3 => 'info',
        2 => 'default',
        1 => 'notice'
    ];

    protected $fillable = ['name', 'description', 'attention_level'];

    public function tasks()
    {
        return $this->belongsToMany('App\Task')->withTimestamps();
    }
}
