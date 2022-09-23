<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;

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


Route::get('login', 'testController@login')->name('login');

Route::group(['middleware'=>['checkAuth']], function(){

Route::get('getSongs', 'testController@getSongs');
Route::get('home', 'testController@home')->name('home');
Route::get('/', 'testController@home');
Route::get('about', 'testController@about')->name('about');
Route::get('social', 'testController@social')->name('social');
Route::get('radio', 'testController@radio')->name('radio');
Route::post('updateBio', 'testController@updateBio')->name('updateBio');


});



Route::post('login', 'testController@login_post')->name('loginP');
Route::get('logout', 'testController@logout')->name('logout');
Route::get('register', 'testController@register')->name('register');
Route::post('register', 'testController@register_post')->name('registerP');

//Route::get('{anypath}', 'testController@home')->where('path', '.*');


 Route::get('breakdown','testController@breakdown')->name('breakdown');
