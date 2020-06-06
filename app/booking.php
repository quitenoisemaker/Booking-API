<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\support\Str;

class booking extends Model
{
    //


    protected $hidden = [
        'from', 'to',
    ];

    public function bookable(){

        return $this->belongsTo(bookable::class);
    }

    public function review()
    {
        return $this->hasOne(review::class);
    }

    public function scopeBetweenDates(Builder $query, $from, $to){// using the queryscope to query the date in the bookings 

        return $query->where('to', '>=', $from)->where('from', '<=', $to);
    }


    // ADDING A STATIC METHOD WITH NAME findByReviewKey to a booking with a reviewKey
    public static function findByReviewKey(string $reviewKey): ?booking // ?booking means the model should return something or it should be null
    {
        return static::where('review_key', $reviewKey)->with('bookable')->get()->first();
    }


    //the static boot() method is automatically run whenever a model is instantiated
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) { //binding the review_key to an existing model (booking)
            $booking->review_key = Str::uuid();
        });
    }



}
