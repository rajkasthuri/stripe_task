<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/','ProductController@viewProduct');
Route::get('product/{productid}','ProductController@getProduct');
Route::post('checkout','ProductController@postStripePayment');

//Stripe Redirect URL
Route::get('paymentcompleted','ProductController@paymentCompleted')->name('paymentcompleted');

