<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class class_room extends Model
{
    use SoftDeletes;

    /**
     * get the subjects
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }


    /**
     * get the lecturer
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lecturer()
    {
        return $this->belongsTo('App\Lecturer');
    }

    /**
     * get the student belong to classroom
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function class_room_has_student()
    {
        return $this->hasMany('App\class_room_has_student');
    }
}
