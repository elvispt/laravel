<?php

namespace App\Enums;

abstract class NoteVisibility
{
    const PRIVATE = 'PRIVATE';
    const PUBLIC = 'PUBLIC';

    /**
     * @return string[]
     */
    public static function all(): array
    {
        return [
            self::PRIVATE,
            self::PUBLIC,
        ];
    }
}
