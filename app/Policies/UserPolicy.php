<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(User $user, User $model)
    {
        return true;
    }

    public function update(User $user, User $model)
    {
        return ($user->id === $model->id);
    }
}
