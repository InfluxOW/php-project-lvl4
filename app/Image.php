<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = ['path', 'url'];

    public function image()
    {
        return $this->belongsTo('App\User');
    }
}
