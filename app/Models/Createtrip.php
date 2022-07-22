<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Createtrip extends Model
{
    use HasFactory,SoftDeletes;

     public function user()
    {
        return $this->belongsTo('App\Models\CreateTravel', 'traveller_id','id');
    }
     public function ratings()
    {
        return $this->hasMany('App\Models\UserReview', 'trip_id','id');
    }
     public function booking()
    {
        return $this->hasMany('App\Models\Booking', 'trip_id','id');
    }
    
     public function locationImage()
    {
        return $this->belongsTo('App\Models\LocationImage', 'trip_id','trip_id');
    }

     public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $id = Createtrip::max('id') + 1;
            $model->trip_id = date('y')."".date('m')."".$id;
        });
    }

    use Sortable;

    public $sortable = ['id','trip_title','trip_id','B_number','type_of_trip','start_location','status','end_location','duration','cost','created_at','updated_at'];

}