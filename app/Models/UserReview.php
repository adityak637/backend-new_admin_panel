<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserReview extends Model
{
    use HasFactory;

    public function trip()
    {
        return $this->belongsTo('App\Models\Createtrip', 'trip_id','id');
    }
    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

}