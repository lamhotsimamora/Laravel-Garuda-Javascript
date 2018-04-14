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
use App\m_user;

Route::get('/', function () {
    return view('home');
});

Route::get('/add','c_user@add');
Route::post('/add','c_user@add');

Route::get('/update','c_user@update');
Route::post('/update','c_user@update');

Route::get('/delete','c_user@delete');
Route::post('/delete','c_user@delete');


Route::get('/get-data','c_user@getAllDataUser');


Route::get('/get-data-single','c_user@getUser');
Route::post('/get-data-single','c_user@getUser');

Route::get('/upload/{id}','c_upload@index');
Route::post('/store-upload/{id}','c_upload@uploadFoto');


Route::get('/show','c_upload@show');


/*Route::redirect('/this', '/that', 301);

Route::get('/that',function(){
	// asset('storage/file.txt');
});

Route::view('/oke','/siap');

Route::get('posts/{post}/comments/{comment}', function ($postId, $commentId) {
    echo $postId;
    echo "<br>";
    echo $commentId;
});

Route::get('/example',function(){
	return redirect()->route('oke');
});*/