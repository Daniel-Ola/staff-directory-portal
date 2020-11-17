<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['user_id', 'subject', 'details', 'sub', 'dept', 'all_of_us'];


    public function user() {
        return $this->belongsTo('App\User');
    }
}
