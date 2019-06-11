<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class student_class_request extends Model
{
    use SoftDeletes;

    /**
     * get the subject
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    /**
     * get the student
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    /**
     * get the payment that student make
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payment()
    {
        return $this->hasOne('App\Payment');
    }

    /**
     * get the request approval details
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function approve()
    {
        return $this->hasOne('App\Class_request_approval');
    }
}
