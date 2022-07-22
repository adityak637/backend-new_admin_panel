<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TravellerController;
use App\Http\Controllers\Admin\TravellerTripController;
use App\Http\Controllers\Admin\EnquirysController;
use App\Http\Controllers\Admin\Bookingdetails;
use App\Http\Controllers\Admin\UserReviewssController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacingIssuesController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GeneralQuerysController;
use App\Http\Controllers\Admin\UsersIssuesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

Route::get('/',[DashboardController::class,'index']);
Route::get('/logout',[AdminLoginController::class,'doAdminLogout']);
Route::get('/login', function () {
    return  view('Admin.login');
});

Route::get('/create_traveller', function () {
    return  view('Admin.create_traveller');
});
//User Route
Route::get('/user',[UserController::class,'index']);

Route::get('/create_user',[UserController::class,'create']);
Route::post('store-user',[UserController::class,'store']);
Route::get('/user_delete/{id}',[UserController::class,'delete']);
Route::get('/user_view/{id}',[UserController::class,'user_view']);
Route::get('/edit_user/{id}',[UserController::class,'edit_user']);
Route::post('/edit_user',[UserController::class,'update_user'])->name('user_edit');
Route::get('/userstatus/{id}/{status}',[UserController::class,'status'])->name('userstatuss');
Route::post('/userssearch',[UserController::class,'search']);
Route::post('/user_details_serach/{id}',[UserController::class,'user_details_serach']);

// Route::get('/edit_user', function () {
//     return  view('Admin.edit_user');
// });
Route::get('/edit_traveller/{id}',[TravellerController::class,'edit_traveller'])->name('edit_traveller');
Route::post('/edit_traveller_profile/{id}',[TravellerController::class,'edit_traveller_profile'])->name('edit_traveller_profile');

// 12-12-2021
//create_traveller
Route::post('/create_traveller',[TravellerController::class,'create'])->name('create_traveller');
Route::get('/traveller_user',[TravellerController::class,'fetchtraveller']);
Route::get('/travel_delete/{id}',[TravellerController::class,'travel_delete'])->name('travel_delete');
Route::get('/travel_view/{id}',[TravellerController::class,'travel_view'])->name('travel_view');
Route::get('/status/{id}/{status}',[TravellerController::class,'status'])->name('status');
Route::post('/search',[TravellerController::class,'search'])->name('search');
Route::post('/traveller_details_serach/{id}',[TravellerController::class,'traveller_details_serach']);


//trip
Route::get('/trip',[TravellerTripController::class,'index']);
Route::get('/trip_view/{id}',[TravellerTripController::class,'fetch'])->name('trip_view');
Route::get('/trip_search',[TravellerTripController::class,'tripsearch'])->name('tripsearch');
Route::post('/trip_details_serach/{id}',[TravellerTripController::class,'trip_details_serach']);


Route::get('/enquirys',[EnquirysController::class,'index']);
Route::get('/enquirys/{id}',[EnquirysController::class,'show']);
Route::get('/enquirys/{id}/{status}',[EnquirysController::class,'enquirystatus'])->name('enquirystatus');
Route::post('/enquirydetailsearch',[EnquirysController::class,'enquirydetailsearch'])->name('enquirydetailsearch');

//tripstatus
Route::get('/tripstatus/{id}/{status}',[TravellerTripController::class,'tripstatus']);

//facing issue
Route::get('/facingissues',[FacingIssuesController::class,'index']);
Route::get('/facingissues/{id}',[FacingIssuesController::class,'show']);
Route::get('/facingissues/{id}/{status}',[FacingIssuesController::class,'status'])->name('facingissuestatus');
Route::post('/facingissuessearch',[FacingIssuesController::class,'facingissuessearch'])->name('facingissuessearch');

//user_review
Route::get('/user_review',[UserReviewssController::class,'index']);
Route::get('/user_review/{id}',[UserReviewssController::class,'show']);
Route::get('/user_review/{id}/{status}',[UserReviewssController::class,'status'])->name('user_reviewstatus');
Route::post('/user_reviewsearch',[UserReviewssController::class,'user_reviewsearch'])->name('user_reviewsearch');

Route::get('/user_booking_fetch',[Bookingdetails::class,'index']);
Route::get('/enquiry_details',function(){
    return view('Admin.enquiry_details');
});

});
Route::get('/login',[AdminLoginController::class,'index'])->name('login');

Route::post('/login',[AdminLoginController::class,'logindetailes'])->name('logindetailes');
Route::get('/generalquerys',[GeneralQuerysController::class,'index']);
Route::get('/generalquerys/{id}/{status}',[GeneralQuerysController::class,'generalquerysstatus'])->name('generalquerysstatus');
Route::post('/generalquerysserach',[GeneralQuerysController::class,'generalquerysserach'])->name('generalquerysserach');
Route::get('/usersissues',[UsersIssuesController::class,'index']);
Route::get('/usersissues/{id}/{status}',[UsersIssuesController::class,'usersissuesstatus'])->name('usersissuesstatus');
Route::post('/usersissuessearch',[UsersIssuesController::class,'usersissuessearch'])->name('usersissuessearch');