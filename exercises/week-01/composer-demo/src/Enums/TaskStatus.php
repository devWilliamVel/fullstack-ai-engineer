<?php

declare(strict_types=1);

namespace App\Enums;

enum TaskStatus: string
{
    case Pending = 'pending';
    case InProgress = 'in_progress';
    case Done = 'done';

    public function description(): string
    {
        return match($this) {
            self::Pending => 'The task is pending.',
            self::InProgress => 'The task is in progress.',
            self::Done => 'The task is done.',
        };
    }
}