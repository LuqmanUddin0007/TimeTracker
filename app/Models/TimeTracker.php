<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTracker extends Model
{
    use HasFactory;

    protected $fillable = ['uid', 'started_at', 'stoped_at', 'total_work_minutes', 'created_at', 'updated_at'] ;
}
