<?php

namespace App\Policies;

use tizis\laraComments\Contracts\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;
use tizis\laraComments\Policies\CommentPolicy as CommentPolicyPackage;

class CommentPolicy extends CommentPolicyPackage
{
    use HandlesAuthorization;

    public function delete($user, Comment $comment): bool
    {
        return ($user->id === $comment->commenter->id);
    }

    public function edit($user, Comment $comment): bool
    {
        return ($user->id === $comment->commenter->id);
    }
}
