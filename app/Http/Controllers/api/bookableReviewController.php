<?php

namespace App\Http\Controllers\api;

use App\bookable;
use App\Http\Controllers\Controller;
use App\Http\Resources\bookableReviewIndexResource;
use Illuminate\Http\Request;

class bookableReviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, Request $request)
    {
        //

        $bookable = bookable::findOrFail($id);

        return bookableReviewIndexResource::collection( // adding the resource as a collection to determine what data should be shown

            $bookable->reviews()->latest()->get() //linking the bookable with the relation and using the latest() to get the latest reviews
        ); 
    }
}
