<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['user_id', 'subject','details'];


    public function user() {
        return $this->belongsTo('App\User');
    }
}
