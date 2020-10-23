<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $fillable = [
        'name', 'parent', 'has_child', 'user_id', 'has_subfolder', 'slug', 'path', 'scope', 'sub', 'dept'
    ];
}
