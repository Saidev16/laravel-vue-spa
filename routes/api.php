<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Route::middleware('api')->group(function () {
// });
Route::resource('categories', 'CategoryController');
// Route::get('/getCategories', 'CategoryController@index');
Route::resource('/products', 'ProductController');

