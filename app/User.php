<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use tizis\laraComments\Traits\Commenter;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Task[] $assignedTasks
 * @property-read int|null $assigned_tasks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\tizis\laraComments\Entity\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\tizis\laraComments\Entity\CommentVotes[] $commentsVotes
 * @property-read int|null $comments_votes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\tizis\laraComments\Entity\Comment[] $commentsWithChildrenAndCommenter
 * @property-read int|null $comments_with_children_and_commenter_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Task[] $createdTasks
 * @property-read int|null $created_tasks_count
 * @property-read \App\Image|null $image
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static Builder|User assignee()
 * @method static Builder|User creator()
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;
    use Commenter;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
     * Relations
     * */

    public function createdTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'creator_id');
    }

    public function assignedTasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_assignee', 'assignee_id', 'task_id');
    }

    public function image(): HasOne
    {
        return $this->hasOne(Image::class);
    }

    /*
     * Scopes
     * */

    public function scopeAssignee(Builder $query): Builder
    {
        return $query->whereHas('assignedTasks');
    }

    public function scopeCreator(Builder $query): Builder
    {
        return $query->whereHas('createdTasks');
    }
}
