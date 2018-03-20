<?php

namespace FanClub\model;

use Illuminate\Database\Eloquent\Model;

class ActionUser extends Model
{
    protected $table = 'action_user';

    protected $fillable = [
        'user_id',
        'action_id',
        'score',
        'description',
        'data',
        'created_at'
    ];
    public $timestamps = false;
}
