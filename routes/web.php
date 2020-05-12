<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/* here we created a fallback route that will match every single URL with
the main route but prevent the route with "api"  */
Route::get('/{any?}', function () {  /* adding the {any?} helps us to create a fallback route - we can call it anything */
    return view('welcome');
})->where('any', '^(?!api\/)[\/\w\.-]*'); /* here is the regular expression that prevent the /api */
