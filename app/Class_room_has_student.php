<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Class_room_has_student extends Model
{
    use SoftDeletes;

    /**
     * Get the classroom.
     */
    public function class_room()
    {
        return $this->belongsTo('App\Class_room');
    }

    /**
     * Get the student.
     */
    public function student()
    {
        return $this->belongsTo('App\Student');
    }
}
