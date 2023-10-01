<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        /**
         * Route::has('login') returns a boolean value, true or false. It will be true if there is 
         * a named route named 'login' defined in your Laravel application's route configuration 
         * and false if it doesn't exist.
         */
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    /**
     * This is an array of middleware names that will be applied to the routes within the group.
     */
    'auth:sanctum',//checks if the user is authenticated using Laravel Sanctum. 
    config('jetstream.auth_session'),
    'verified',// checks if the user's email address has been verified
])->group(function () {//This code sets up a group of routes that share authentication middleware
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');//it's using the Inertia.js library to render a 'Dashboard' component.
    })->name('dashboard');
});


Route::get('photos', function () {
    //dd(Photo::all());
    // return Inertia::render('Guest/Photos');
    return Inertia::render('Photos');

});