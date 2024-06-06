<?php

namespace App\Enum;

enum ShoeCategory: string
{
    case Women = 'woman';
    case Men = 'men';
    case Children = 'children';

    public function getlabel(): string
    {
        return match ($this) {
            self::Women => "femme",
            self::Men => "homme",
            self::Children => "enfants",
        };
    }
}