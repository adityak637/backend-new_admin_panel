<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class FacingIssue extends Model
{
    use HasFactory;

      use Sortable;

    public $sortable = ['id','title','details','name','email','phone_no','status'];
}