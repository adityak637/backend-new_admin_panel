<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CreateTripController;
use App\Http\Controllers\CreateTravelController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\FacingIssueController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UserReviewController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\BookingtripController;
use App\Http\Controllers\GeneralQueryController;
use App\Http\Controllers\InterestedTripControllerController;
use App\Http\Controllers\UsersIssueController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:sanctum'], function(){
// User logout
Route::get('/logout',[UserController::class,'logout']);

Route::get('/me', function(Request $request) {
        return auth()->user();
    });

// Traveller Logout
Route::post('/Traveller_logout',[CreateTravelController::class,'logout']);

// User profile update
Route::post('/update-details/{id}',[UserController::class,'updatedetails']);

// Traveller profile deatils
Route::post('/travelDetail/{id}',[CreateTravelController::class,'travel_update']);

// Traveller Create Trips
Route::post('/create_trip',[CreateTripController::class,'index']);
Route::post('/create_trip_submit',[CreateTripController::class,'submit']);
Route::post('/search/{id}',[CreateTripController::class,'search']);
Route::get('/archived/{id}',[CreateTripController::class,'archived']);
Route::get('/archived_submit/{id}',[CreateTripController::class,'archived_submit']);
Route::get('/underreview/{id}',[CreateTripController::class,'underreview']);
Route::get('/rejecttrip/{id}',[CreateTripController::class,'rejecttrip']);
Route::get('/ongoing/{id}',[CreateTripController::class,'ongoing']);
Route::get('/canceltrip/{id}',[CreateTripController::class,'canceltrip']);
Route::get('/completedtrip/{id}',[CreateTripController::class,'completedtrip']);
Route::get('/promocode/{id}/{promocode}',[CreateTripController::class,'promocode']);

// KYC
Route::post('/document/{id}',[DocumentController::class,'index']);

Route::post('/user_review',[UserReviewController::class,'index']);

// Traveller Support
Route::post('/enquiry',[CreateTripController::class,'enquiry']);

Route::post('/booking',[BookingtripController::class,'index']);
Route::post('/bookingTrip',[BookingtripController::class,'booking']);
Route::post('/completedtrip',[BookingtripController::class,'completedbooking']);
Route::post('/failedbooking',[BookingtripController::class,'failBooking']);
Route::post('/cancelbooking',[BookingtripController::class,'cancelbooking']);

Route::post('/dashboard/{id}',[CreateTravelController::class,'dashboard']);

Route::post('/addinterest',[InterestedTripControllerController::class,'add']);
Route::post('/interested',[InterestedTripControllerController::class,'interested']);
Route::post('/removeinterrest',[InterestedTripControllerController::class,'remove']);

    });


// Booking 2nd stage
Route::post('/booking',[BookingtripController::class,'index']);

// User register
Route::post('/register',[UserController::class,'register']);
Route::post('/verifiedpassword',[UserController::class,'verifiedpassword']);

// google login
Route::get('/google', [UserController::class,'redirectGoogle'])->name('google');
Route::get('/google/callback', [UserController::class,'runCallback']);

// api/login
Route::post('/login',[UserController::class,'login']);

// api for Update password
Route::post('/change-password/{id}',[UserController::class,'changepassword']);
// api forgetpassword 
Route::post('/forgot-password',[UserController::class,'forgot_password']);
// api reset_password
Route::post('/reset-password',[UserController::class,'reset_password']);

// Traveller login
Route::post('/otp',[CreateTravelController::class,'otp']);
Route::post('/traveller_login',[CreateTravelController::class,'login']);

// Travellers Facing any issue while login
Route::post('/facingissue',[FacingIssueController::class,'index']);

// Website
Route::post('/showsdata',[WebsiteController::class,'index']);
Route::get('/triplist/{id}',[WebsiteController::class,'triplist']);
Route::get('/hotlocation',[WebsiteController::class,'hotlocation']);
Route::get('/randomtrip',[WebsiteController::class,'randomtrip']);
Route::post('/get-search-items',[WebsiteController::class,'get_search_items']);

//gernerl_query
Route::post('/query',[GeneralQueryController::class,'index']);
//Users Query
Route::post('/usersquery',[UsersIssueController::class,'index']);
