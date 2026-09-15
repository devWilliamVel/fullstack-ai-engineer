<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\TaskStatus;

class Task
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly TaskStatus $status,
        public readonly bool $Priority = false,
    ) { }

    public function isCompleted(): bool
    {
        return $this->status === TaskStatus::Done;
    }

    public function summary(): string
    {
        $prioridad = $this->Priority ? '[PRIORITARY] ' : '';
        return sprintf(
            '%s#%d %s - %s',
            $prioridad,
            $this->id,
            $this->title,
            $this->status->description()
        );
    }
}