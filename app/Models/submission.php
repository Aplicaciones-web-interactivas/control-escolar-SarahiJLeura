<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class submission extends Model
{
    protected $fillable = ['file_path','task_id','student_id'];

    public function task(){
        return $this->belongsTo(Task::class);
    }

    public function student(){
        return $this->belongsTo(User::class, 'student_id');
    }
}
