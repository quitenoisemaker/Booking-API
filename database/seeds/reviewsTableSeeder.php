<?php

use App\bookable;
use App\review;
use Illuminate\Database\Seeder;

class reviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        bookable::all()->each(function (bookable $bookable) {
            $reviews =factory(review::class, random_int(5, 30))->make();
            $bookable->reviews()->saveMany($reviews);
        });
    }
}
