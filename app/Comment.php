<?php

namespace App;

use tizis\laraComments\Entity\Comment as laraComment;

/**
 * App\Comment
 *
 * @property int $id
 * @property int $commenter_id
 * @property string $commentable_type
 * @property int $commentable_id
 * @property string $comment
 * @property int|null $child_id
 * @property int $rating
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Comment[] $allChildrenWithCommenter
 * @property-read int|null $all_children_with_commenter_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Comment[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $commentable
 * @property-read \App\User $commenter
 * @property-read Comment|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\tizis\laraComments\Entity\CommentVotes[] $votes
 * @property-read int|null $votes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment parentless()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereChildId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommenterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Comment extends laraComment
{
    //
}
