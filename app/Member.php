<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;

    protected $table = 'members';

    protected $fillable = [
        'code', 'type', 'name', 'slug', 'email', 'phone', 'gender', 'address', 'description'
    ];

    protected $hidden = [
        
    ];
}
