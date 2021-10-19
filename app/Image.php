<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Image
 *
 * @property int $id
 * @property string $path
 * @property string $url
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $image
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUserId($value)
 * @mixin \Eloquent
 */
class Image extends Model
{
    protected $fillable = ['path', 'url'];

    public function image(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
