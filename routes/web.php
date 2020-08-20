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



Auth::routes();

//DELETE FROM REGISTRATION PAGE
Route::match(['GET', 'POST'], '/register', function () {
    return redirect("/login");
})->name("register");

Route::get('/', function () {
    return view('auth.login');
});

//DEFAULT PAGE
Route::get('/home', 'HomeController@index')->name('home');
//USER PAGE CONTROLLER 
Route::resource('users', 'UserController');
//CATEGORY CONTROLLER PAGE
Route::get('/ajax/categories/search', 'CategoryController@ajaxSearch');
Route::get('/categories/trash', 'CategoryController@trash')->name('categories.trash');
Route::get('/categories/{id}/restore', 'CategoryController@restore')->name('categories.restore');
Route::delete('/categories/{category}/delete-permanent', 'CategoryController@deletePermanent')->name('categories.delete-permanent');
Route::resource('categories', 'CategoryController');

//DELETE PERMANENT DATA BOOKS
Route::delete('/books/{id}/delete-permanent', 'BookController@deletePermanent')->name('books.delete-permanent');
//RESTORE DATA BOOKS
Route::post('/books/{book}/restore', 'BookController@restore')->name('books.restore');
//TRASH BOOKS CONTROLLER PAGE
Route::get('/books/trash', 'BookController@trash')->name('books.trash');
//BOOKS CONTROLLER PAGE
Route::resource('books', 'BookController');
//ORDERS CONTROLLER PAGE
Route::resource('orders', 'OrderController');