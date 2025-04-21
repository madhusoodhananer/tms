<?php

namespace App\Models;

use App\Models\AppModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class TaskTimeTracker extends AppModel
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'seq','task_id', 'assignee', 'started_at', 'ended_at', 'duration', 
    ];
}
