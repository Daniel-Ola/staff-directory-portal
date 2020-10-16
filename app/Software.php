<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $table = 'softwares';

    protected $fillable = [
        'icon', 'name', 'url', 'description',
    ];
}
