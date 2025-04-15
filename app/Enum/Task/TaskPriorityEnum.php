<?php

namespace App\Enum\Task;

enum TaskPriorityEnum: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';
}
