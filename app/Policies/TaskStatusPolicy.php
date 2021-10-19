<?php

namespace App\Policies;

use App\TaskStatus as Status;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskStatusPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Status $status)
    {
        if (in_array($status->name, Status::DEFAULT_STATUSES, true)) {
            return false;
        }

        return true;
    }

    public function delete(User $user, Status $status)
    {
        if (in_array($status->name, Status::DEFAULT_STATUSES, true)) {
            return false;
        }

        return true;
    }
}
