<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use tizis\laraComments\Contracts\ICommentable;
use tizis\laraComments\Traits\Commentable;
use App\Enums\TaskStatus as TaskStatusEnum;

/**
 * App\Task
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $status_id
 * @property int $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $assignees
 * @property-read int|null $assignees_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $commentsWithChildrenAndCommenter
 * @property-read int|null $comments_with_children_and_commenter_count
 * @property-read \App\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Label[] $labels
 * @property-read int|null $labels_count
 * @property-read \App\TaskStatus $status
 * @method static Builder|Task completed()
 * @method static Builder|Task newModelQuery()
 * @method static Builder|Task newQuery()
 * @method static \Illuminate\Database\Query\Builder|Task onlyTrashed()
 * @method static Builder|Task query()
 * @method static Builder|Task whereCreatedAt($value)
 * @method static Builder|Task whereCreatorId($value)
 * @method static Builder|Task whereDeletedAt($value)
 * @method static Builder|Task whereDescription($value)
 * @method static Builder|Task whereId($value)
 * @method static Builder|Task whereName($value)
 * @method static Builder|Task whereStatusId($value)
 * @method static Builder|Task whereUpdatedAt($value)
 * @method static Builder|Task withCommentsCount()
 * @method static \Illuminate\Database\Query\Builder|Task withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Task withoutTrashed()
 * @mixin \Eloquent
 */
class Task extends Model implements ICommentable
{
    use SoftDeletes;
    use Commentable;

    protected $fillable = ['name', 'description', 'status_id'];

    /*
     * Relations
     * */

    public function status(): BelongsTo
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function assignees(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'task_assignee', 'task_id', 'assignee_id')->withTimestamps();
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class, 'task_label')->withTimestamps();
    }

    /*
     * Scopes
     * */

    public function scopeCompleted(Builder $query)
    {
        return $query->whereHas('status', function (Builder $query): Builder {
            return $query->where('name', TaskStatusEnum::COMPLETED);
        });
    }
}
