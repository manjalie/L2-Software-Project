<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    const LECTURER_TYPE = 'lecturer';
    const MODERATOR_TYPE = 'moderator';
    const ADMIN_TYPE = 'admin';
    const STUDENT_TYPE = 'student';
    const DEFAULT_TYPE = 'default';
    const ACTIVE_TYPE = 'active';

//------------------------getting user active status----------------------------------
   public function isActive(){
       return $this->status === self::ACTIVE_TYPE;
   }

// -------------------------------middleware lecturer---------------------------------------------------------
    public function isLecturer()    {
        return $this->role === self::LECTURER_TYPE;
    }

// -------------------------------middleware student---------------------------------------------------------
    public function isStudent()    {
        return $this->role === self::STUDENT_TYPE;
    }

// -------------------------------middleware admin---------------------------------------------------------
    public function isAdmin()    {
        return $this->role === self::ADMIN_TYPE;
    }

    // -------------------------------middleware admin---------------------------------------------------------
    public function isModerator()    {
        return $this->role === self::MODERATOR_TYPE;
    }



    protected $fillable = [
        'first_name','last_name', 'email', 'password','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
