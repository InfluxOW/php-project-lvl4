<?php

namespace Tests;

use App\Status;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function user()
    {
        return factory(User::class)->create();
    }

    protected function status()
    {
        return factory(Status::class)->states('new')->create();
    }
}
