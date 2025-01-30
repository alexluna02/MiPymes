<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = ['user_id', 'action','model','model_id','old_value','new_value'];
    protected $table = 'activity_log';
}
