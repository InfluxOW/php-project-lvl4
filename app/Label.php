<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Label
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $attention_level
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Task[] $tasks
 * @property-read int|null $tasks_count
 * @method static \Illuminate\Database\Eloquent\Builder|Label newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Label newQuery()
 * @method static \Illuminate\Database\Query\Builder|Label onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Label query()
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereAttentionLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Label withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Label withoutTrashed()
 * @mixin \Eloquent
 */
class Label extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'attention_level'];

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class)->withTimestamps();
    }
}
