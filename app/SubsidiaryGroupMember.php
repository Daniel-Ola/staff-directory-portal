<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubsidiaryGroupMember extends Model
{
    protected $fillable = ['group_id', 'sub_id'];
}
