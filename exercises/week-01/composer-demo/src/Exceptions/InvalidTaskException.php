<?php
declare(strict_types=1);

namespace App\Exceptions;

use InvalidArgumentException as IException;

class InvalidTaskException extends IException
{
    public static function emptyTitle(): self
    {
        return new self('The task title cannot be empty.');
    }

    public static function titleTooLong(int $maxLength): self
    {
        return new self(sprintf('The task title cannot exceed %d characters.', $maxLength));
    }
}