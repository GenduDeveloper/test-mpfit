<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case NEW       = 'новый';
    case COMPLETED = 'выполнен';
}
