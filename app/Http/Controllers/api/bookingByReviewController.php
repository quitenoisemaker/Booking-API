<?php

namespace App\Http\Controllers\api;

use App\booking;
use App\Http\Controllers\Controller;
use App\Http\Resources\bookingByReviewShowResource;
use Illuminate\Http\Request;

class bookingByReviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($reviewKey, Request $request)
    {
        //
         $booking =  booking::findByReviewKey($reviewKey);
        return $booking ? new bookingByReviewShowResource($booking) : abort(404) ;// when it is not null it should return whats on the left but when its null it should return the right hand side
    }
}
