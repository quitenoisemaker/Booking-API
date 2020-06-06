<?php

use App\bookable;
use App\booking;
use Illuminate\Database\Seeder;

class bookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        bookable::all()->each(function (bookable $bookable) {//here we are getting all the element in the model "bookable" and Execute a callback over each item
            $booking = factory(booking::class)->make();//here we are making a factory of booking and storing it in $booking variable
            $bookings = collect([$booking]); // creating a collection of the $booking and storing it in the $bookings

            for ($i=0; $i <  random_int(1, 20); $i++) { 
                # code...
                $from = (clone $booking->to)->addDays(random_int(1, 14));//cloning the booking model ($booking) and giving it a random days
                $to = (clone $from)->addDays(random_int(0, 14));//cloning the $from(which is the $booking) and giving it a random days

                $booking = booking::make([//here making a new booking model and assigning all the table attribute
                    'from' => $from, //required attribute in the booking model
                    'to' => $to //required attribute in the booking model
                ]);

                $bookings->push($booking);// pushing the new booking model to the $bookings collection
            }

            $bookable->bookings()->saveMany($bookings);//saving all the collections($bookings) to the bookable model using
            //the relationship function (bookings)
        });
    }
}
