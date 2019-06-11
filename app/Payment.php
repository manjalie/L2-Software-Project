<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    /**
     * this belong to student class request
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student_class_request()
    {
        return $this->belongsTo('App\Student_class_request');
    }
}
