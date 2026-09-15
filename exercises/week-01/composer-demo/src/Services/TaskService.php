<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Task;
use App\Enums\TaskStatus;
use App\Exceptions\InvalidTaskException;

class TaskService
{
    const MAX_TITLE_LENGTH = 100;
    
    private array $tasks = [];
    private int $nextId = 1;

    public function addTask(string $title, TaskStatus $status, bool $Priority = false): Task
    {
        $title = trim($title);
        if ($title === '') {
            throw InvalidTaskException::emptyTitle();
        }
        if (mb_strlen($title) > self::MAX_TITLE_LENGTH) {
            throw InvalidTaskException::titleTooLong(self::MAX_TITLE_LENGTH);
        }

        $task = new Task(
            id: $this->nextId++,
            title: $title,
            status: $status,
            Priority: $Priority,
        );
        $this->tasks[$task->id] = $task;
        return $task;
    }

    public function completeTask(int $id): ?Task
    {
        if (!isset($this->tasks[$id])) {
            return null;
        }
        $task = $this->tasks[$id];
        $completedTask = new Task(
            id: $task->id,
            title: $task->title,
            status: TaskStatus::Done,
            Priority: $task->Priority,
        );
        $this->tasks[$id] = $completedTask;
        return $completedTask;
    }

    /**
     * Get all tasks.
     * @return array<int, Task>, An array of all tasks.
     */
    public function getTasks(): array
    {
        return $this->tasks;
    }
}