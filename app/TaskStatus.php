<?php

namespace App;

use App\Enums\TaskStatus as TaskStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\TaskStatus
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Task[] $tasks
 * @property-read int|null $tasks_count
 * @method static Builder|TaskStatus newModelQuery()
 * @method static Builder|TaskStatus newQuery()
 * @method static \Illuminate\Database\Query\Builder|TaskStatus onlyTrashed()
 * @method static Builder|TaskStatus query()
 * @method static Builder|TaskStatus whereCreatedAt($value)
 * @method static Builder|TaskStatus whereDeletedAt($value)
 * @method static Builder|TaskStatus whereId($value)
 * @method static Builder|TaskStatus whereName($value)
 * @method static Builder|TaskStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|TaskStatus withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TaskStatus withoutTrashed()
 * @mixin \Eloquent
 */
class TaskStatus extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    public const DEFAULT_STATUSES = [
        TaskStatusEnum::NEW, TaskStatusEnum::TESTING, TaskStatusEnum::PROCESSING, TaskStatusEnum::COMPLETED
    ];


    /*
     * Relations
     * */

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /*
     * Other
     * */

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (self $status): void {
            Task::whereHas('status', function (Builder $query) use ($status): Builder {
                return $query->where('id', $status->id);
            })->delete();
        });
    }
}
