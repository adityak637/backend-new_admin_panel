<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Createtrip;
use App\Models\Booking;
use App\Models\Bookingtrip;
use App\Models\CreateTravel;
use App\Models\UserReview;

class DashboardController extends Controller
{
    public function index(){
        $users=User::where('status',1)->count();
        $Createtrip=Createtrip::count();
        $trip_cancel_by_traveller=Createtrip::where('status',5)->count();
        $total_cost=Booking::where('transaction_status',1)->sum('total_cost');
        $refund_cost=Booking::where('refunds',1)->sum('total_cost');
        $refund_count=Booking::where('refunds',1)->count();
        $query_resolve=UserReview::where('status',1)->count();
        $query_not_resolve=UserReview::where('status',0)->count();
         return  view('Admin.dashboard')->with([
             'users'=>$users,
             'Createtrip'=>$Createtrip,
             'trip_cancel_by_traveller'=>$trip_cancel_by_traveller,
             'total_cost'=>$total_cost,
             'query_resolve'=>$query_resolve,
             'query_not_resolve'=>$query_not_resolve,
             'refund_cost'=>$refund_cost,
             'refund_count'=>$refund_count,
         ]);
    }
}