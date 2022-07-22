<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Enquiry extends Model
{
    use HasFactory,SoftDeletes;

      use Sortable;

    public $sortable = ['id','title','query','status','created_at','updated_at'];

    public function traveller()
    {
        return $this->belongsTo('App\Models\CreateTravel', 'traveller_id','id');
    }
}