<?php

namespace App\Http\Controllers\api;

use App\booking;
use App\Http\Controllers\Controller;
use App\Http\Resources\reviewResource;
use App\review;
use Illuminate\Http\Request;

class reviewController extends Controller
{
    //

    public function show($id) {

        return new reviewResource(review::findOrFail($id)) ;
    }

    public function store(Request $request) {

        $data = $request->validate([

            'id' => 'required|size:36|unique:reviews',
            'content' => 'required|min:2',
            'rating' => 'required|in:1,2,3,4,5'
        ]);

        $booking = booking::findByReviewKey($data['id']);// find the id with the reveiew key

        if (null === $booking) {
            return abort(404);// if no review key, it should abort
        }

        $booking->review_key = ''; //if there are review key it should be empty
        $booking->save(); // save the model

        $review = review::make($data); // finally "make" will create a new instance of review and create all the data in the model

        $review->booking_id = $booking->id; // here we are setting the booking_id ourself to prevent users access to them
        $review->bookable_id = $booking->bookable_id; // here we are setting the bookable_id ourself to prevent users access to them
        $review->save();

        return new reviewResource($review);// keeping it more secured by using the reviewResource so we will know it have been created

    }
}
