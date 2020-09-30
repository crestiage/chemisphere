<?php

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get("/", "MainController@index")->name('home');
Route::get("/main", "MainController@index")->name('main');
Route::get("/team", "MainController@team");

Route::post("/contact", "MainController@processcontact");

// Product Routes
Route::middleware('auth:api')->get("/product", "ProductController@product");
Route::get("/updateProduct/{productId}", "ProductController@updateProduct");
Route::post("/saveProduct", "ProductController@saveProduct");

// Login Routes
// Route::get("/login", "Auth\LoginController@showLoginForm");

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');