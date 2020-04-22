<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\CommentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\TaskStatus' => 'App\Policies\StatusPolicy',
        'App\Task' => 'App\Policies\TaskPolicy',
        'App\Label' => 'App\Policies\LabelPolicy',
        'App\User' => 'App\Policies\UserPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::resource('comments_custom', CommentPolicy::class, [
            'delete' => 'delete',
            'reply' => 'reply',
            'edit' => 'edit',
            'vote' => 'vote',
            'store' => 'store'
        ]);
    }
}
