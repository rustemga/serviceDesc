<?php
use App\Http\Controllers\Auth\RegisterByAdminController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/registerByAdmin', 'Auth\RegisterByAdminController@create')->name('CreateByAdmin');
Route::get('/register', 'UserController@createTable')->name('createTable');
Route::get('/createticket', 'TicketsController@create')->name('createTicket');
Route::get('/ticket/{ticket}', 'TicketsController@show')->name('ticket');
Route::get('/ticket/{ticket}/edit', 'TicketsController@edit')->name('editTicket');
Route::get('/ticket/{ticket}/delete', 'TicketsController@destroy')->name('deleteTicket');
Route::get('/follow/{followingUserId}', 'UserController@following')->name('follow');
Route::get('/profile/{user}', 'UserController@show')->name('profile');

Route::post('/addNewTicket', 'TicketsController@store')->name('addNewTicket');
Route::post('/ticket/{ticket}/update', 'TicketsController@update')->name('updateTicket');
Route::post('/registerByAdmin/newuser', 'Auth\RegisterByAdminController@store')->name('storeNewUser');
Route::post('/department', 'DepartmentController@create')->name('departmentCreate');
Route::post('/ticket/{ticket}/reply', 'ReplyController@store')->name('replyToTicket');
Route::post('/ticket/reply/{reply}/remove', 'ReplyController@destroy')->name('removeReply');
