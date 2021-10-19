<?php

namespace App\Enums;

class TaskStatus extends Enum
{
    public const NEW = 'new';
    public const TESTING = 'testing';
    public const PROCESSING = 'processing';
    public const COMPLETED = 'completed';
}
