<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\bookable;
use App\Http\Resources\bookableIndexResource;
use App\Http\Resources\bookableShowResource;

class bookableController extends Controller
{
    //
    public function index()
    {
        //
        return bookableIndexResource::collection(
            bookable::all()
        );
        
    }

    public function show($id)
    {
        //
        return new bookableShowResource(bookable::findOrFail($id));
    }
}
