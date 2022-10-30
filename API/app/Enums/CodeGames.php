<?php

namespace App\Enums;

Abstract class  CodeGames
{
    public const UNDERCOVER = 'undercover';

    /**
     * @return string[]
     */
    public static function GAMES_CODES(): array
    {
        return [
            self::UNDERCOVER,
        ];
    }
}
