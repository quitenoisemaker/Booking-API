<?php

use App\bookable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('bookables', function (Request $request) {
//     return bookable::all();
// });

// Route::get('bookables/{id}', function (Request $request, $id) {
//     return bookable::findOrFail($id);
// });

// Route::get('bookables', 'api\bookableController@index');
// Route::get('bookables/{id}', 'api\bookableController@show');

// here we user the resource for the controller. and it should show only the 'index' and 'show' controller
 Route::apiResource('bookables', 'api\bookableController')->only(['index', 'show']);
 Route::get('bookables/{bookable}/availability', 'api\bookableAvailabilityController')->name('bookables.availability.show');
 Route::get('bookables/{bookable}/reviews', 'api\bookableReviewController')->name('bookables.reviews.index');

 Route::get('/booking-by-review/{reviewKey}', 'api\bookingByReviewController')->name('booking.by-review.show');

 Route::apiResource('reviews', 'api\reviewController')->only(['show', 'store']); 