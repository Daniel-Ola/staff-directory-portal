<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    protected $fillable = [
        'name', 'folder_id', 'user_id', 'path'
    ];
}
