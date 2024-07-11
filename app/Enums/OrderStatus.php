<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Created = "created";
    case Validated = "validated";
}
