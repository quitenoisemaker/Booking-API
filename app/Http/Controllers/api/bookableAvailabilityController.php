<?php

namespace App\Http\Controllers\api;

use App\bookable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class bookableAvailabilityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, Request $request)
    {
        //validating using Request in laravel7
        $data= $request->validate([
            'from' => 'required|date_format:Y-m-d|after_or_equal:now', 
            'to' => 'required|date_format:Y-m-d|after_or_equal:from'
        ]);

        $bookable=bookable::findOrFail($id);//  finding the bookings

        return $bookable->availableFor($data['from'], $data['to'])
        ? response()->json([])// when it is true it should give the d response 202 ok
    : response()->json([], 404); // when it is false it should give the response 404
    }
}
