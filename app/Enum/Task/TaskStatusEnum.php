<?php

namespace App\Enum\Task;

enum TaskStatusEnum: string
{
    case Todo = 'to_do';
    case InProgress = 'in_progress';
    case InReview = 'in_review';
    case NeedClarification = 'need_clarification';
    case Done = 'done';
    case Cancelled = 'cancelled';
}
