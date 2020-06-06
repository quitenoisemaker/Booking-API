<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bookable extends Model
{
    //

    public function bookings(){

        return $this->hasMany(booking::class);
    }

    public function reviews ()
    {
        return $this->hasMany(review::class);
    }

    public function availableFor($from, $to): bool {

        return 0 == $this->bookings()->betweenDates($from, $to)->count();
    }

}
