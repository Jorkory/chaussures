<?php

namespace App\Enum;

enum ShoeCategory: string
{
    case women = 'femme';
    case men = 'homme';
    case children = 'enfants';
}