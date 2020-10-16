<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSoftware extends Model
{
    protected $table = 'user_softwares';

    protected $fillable = [
        'user_id', 'software_id', 'attribute', 'set_by'
    ];

    public function softwares()
    {
        return $this->belongsTo(User::class);
    }
}
