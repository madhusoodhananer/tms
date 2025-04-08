<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AppModel extends Model
{
    protected $guarded = [];
    protected $keyType = 'string';
    public $incrementing = false;


    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }

            if ($model->isFillable('seq') || array_key_exists('seq', $model->getAttributes())) {
                $model->seq = static::max('seq') + 1;
            }
        });
        
    }
}
