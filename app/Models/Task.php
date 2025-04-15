<?php

namespace App\Models;

use App\Models\AppModel;
use App\Enum\Task\TaskPriorityEnum;
use App\Enum\Task\TaskStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Task extends AppModel
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    protected $casts = [
        'status' => TaskStatusEnum::class,
        'priority' => TaskPriorityEnum::class
    ];

    protected $fillable = [
        'seq','title', 'description', 'priority', 'assigned_to', 'status', 
        'project_id', 'start_date', 'due_date', 'completed_date',
    ];
}
