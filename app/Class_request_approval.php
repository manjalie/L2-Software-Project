<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class class_request_approval extends Model
{
    use SoftDeletes;

    /**
     * get the lecturer
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lecturer()
    {
        return $this->belongsTo('App\Lecturer');
    }

    /**
     * getting student request information
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student_class_request()
    {
        return $this->belongsTo(student_class_request::class);
    }
}
