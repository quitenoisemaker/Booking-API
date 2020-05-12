<?php

use App\bookable;
use Illuminate\Database\Seeder;

class bookablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(bookable::class, 100)->create();
    }
}
