<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{

    protected $fillable = [
        'id', 'content', 'rating',
    ];


    public function bookable()
    {
        return $this->belongsTo(bookable::class);
    }

    public function booking()
    {
        return $this->belongsTo(booking::class);
    }

    // we are overriding it because of the "uuid" use in the table
    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
