<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class CreateTravel extends Model
{
    use HasFactory,SoftDeletes,HasApiTokens,HasRoles;

      use Sortable;

    public $sortable = ['id','First_Name','email','Contact_No','Short_Intro','created_at','updated_at'];

 public function document()
    {
        return $this->belongsTo('App\Models\Document', 'id','traveller_id');
    }

   
    public function tripdetails()
    {
        return $this->belongsTo('App\Models\Createtrip','id','traveller_id');
    }
  }