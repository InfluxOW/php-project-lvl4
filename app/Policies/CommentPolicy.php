<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use tizis\laraComments\Policies\CommentPolicy as CommentPolicyPackage;

class CommentPolicy extends CommentPolicyPackage
{
    use HandlesAuthorization;

    public function delete($user, \tizis\laraComments\Contracts\Comment $comment): bool
    {
        return $user->id === $comment->commenter->id;
    }

    public function edit($user, \tizis\laraComments\Contracts\Comment $comment): bool
    {
        return $user->id === $comment->commenter->id;
    }
}
