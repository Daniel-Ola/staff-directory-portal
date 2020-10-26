<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupHead extends Model
{
    protected $fillable = ['user_id', 'group_id', 'role_id', 'assigned_by'];
}
