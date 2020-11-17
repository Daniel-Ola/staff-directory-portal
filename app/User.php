<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','updated_by', 'phone', 'designation', 'subsidiary', 'access', 'bday', 'day' ,' month', 'department'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function softwares()
    {
        return $this->hasMany(UserSoftware::class);
    }

    public function scopeSubsidiary($query)
    {
        return $query->leftJoin('subsidiaries as sub', 'sub.id', 'users.subsidiary');//->select(['sub.name as subsidiary', 'users.*']);
    }

    public function scopeDesignation($query)
    {
        return $query->leftJoin('designations as desig', 'desig.id', 'users.designation');//->select(['sub.name as subsidiary', 'users.*']);
    }
}
