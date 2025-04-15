<?php

namespace App\Models;

use App\Models\AppModel;
use App\ProjectStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Project extends AppModel
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    protected $casts = [
        'status' => ProjectStatusEnum::class,
    ];

    protected $fillable = [
        'seq','owner', 'title', 'description', 'status', 'start_date', 'end_date'
    ];
}
