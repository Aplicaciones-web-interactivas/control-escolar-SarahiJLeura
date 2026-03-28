<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    protected $fillable = ['title','description','due_date','group_id','teacher_id'];

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function submissions(){
        return $this->hasMany(Submission::class);
    }
}
