<?php

declare(strict_types=1);

// Load the autoloader from Composer
require __DIR__ . '/vendor/autoload.php';

use App\Services\TaskService;
use App\Enums\TaskStatus;
use App\Exceptions\InvalidTaskException;

$service = new TaskService();

// Create tasks
$task1 = $service->addTask('Learn PHP 8.3', TaskStatus::Pending, true);
$task2 = $service->addTask('Configure Composer', TaskStatus::Pending);
$task3 = $service->addTask('Study Laravel deeply', TaskStatus::Pending, true);

echo "=== Tasks created ===\n";
foreach ($service->getTasks() as $task) {
    echo $task->summary() . "\n";
}

echo "\n=== Completing task #2 ===\n";
$service->completeTask(2);

foreach ($service->getTasks() as $task) {
    echo $task->summary() . "\n";
}

echo "\n=== Testing validation ===\n";
try {
    $service->addTask('', TaskStatus::Pending);
} catch (InvalidTaskException $e) {
    echo "Captured error: " . $e->getMessage() . "\n";
}