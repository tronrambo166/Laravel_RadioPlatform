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


Route::group(['middleware'=>['checkAuth']], function(){

//Route::get('getSongs', 'testController@getSongs');
Route::get('home', 'testController@home')->name('home');
//Route::get('/', 'testController@home');
Route::get('about', 'testController@about')->name('about');
Route::get('bio', 'testController@social')->name('bio');
Route::get('radio', 'testController@radio')->name('radio');
Route::post('updateBio', 'testController@updateBio')->name('updateBio');
Route::get('schedules', 'testController@schedules')->name('schedules');
Route::get('streaming', 'testController@streaming')->name('streaming');
Route::get('social', 'testController@realSocial')->name('social');
Route::get('payout', 'testController@payout')->name('payout');
Route::get('myMusic', 'testController@myMusic')->name('myMusic');
Route::get('albumSongs={album_id}', 'testController@albumSongs')->name('albumSongs');
//MP3
Route::post('singleMp3Upload', 'testController@singleMp3Upload')->name('singleMp3Upload');
Route::post('albumUpload', 'testController@albumUpload')->name('albumUpload');



});

Route::get('getSongs', 'testController@getSongs');
Route::post('login', 'testController@login_post')->name('loginP');
Route::get('logoutA', 'testController@logout')->name('logoutA');
Route::get('register', 'testController@register')->name('register');
Route::post('register', 'testController@register_post')->name('registerP');

//Route::get('{anypath}', 'testController@home')->where('path', '.*');


 Route::get('breakdown','testController@breakdown')->name('breakdown');
 
 

 //USER PART
 Route::get('/', 'userController@static20')->name('login');
 Route::get('static20', 'userController@static20')->name('static20');

 Route::post('user_reg', 'userController@user_reg')->name('user_reg');
 Route::post('Userlogin', 'userController@Userlogin')->name('Userlogin');

 Route::get('UserHome', 'userController@UserHome')->name('UserHome');
 Route::get('live', 'userController@live')->name('live');
 Route::get('getTop20', 'userController@getSongs');
 Route::get('artists', 'userController@artists')->name('artists');
 Route::get('artist_profile-{id}', 'userController@artist_profile')->name('artist_profile');
 Route::get('artist_contact', 'userController@artist_contact')->name('artist_contact');
 Route::post('sendEmail', 'userController@sendEmail')->name('sendEmail');
 Route::get('searchArtist', 'userController@searchArtist')->name('searchArtist');
 Route::get('move', 'userController@move')->name('move');

 
//Forgot Password
Route::get('forgot/{remail}', 'testController@forgot')->name('forgot');
Route::post('send_reset_email', 'testController@send_reset_email')->name('send_reset_email');
Route::post('reset/{remail}', 'testController@reset')->name('reset');

//Artist private sign up
Route::get('artist_signup/{remail}', function ($remail)
{
    return view('artist_signup',compact('remail'));
});



//Streaming
Route::get('update_id{type}', 'streamController@update_id')->name('update_id');
Route::post('insert_id', 'streamController@insert_id')->name('insert_id');

//Deezer
Route::get('youtube', 'streamController@youtube')->name('youtube');
Route::get('spotify', 'streamController@spotify')->name('spotify');
Route::get('apple', 'streamController@apple')->name('apple');
Route::get('boomplay', 'streamController@boomplay')->name('boomplay');
Route::get('mdundo', 'streamController@mdundo')->name('mdundo');
Route::get('deezer', 'streamController@getDeezer')->name('deezer');

Route::get('overall10', function(){return view('streaming.overall10');})->name('overall10');
Route::get('AjaxOverall10', 'streamController@overall10');
Route::get('region10', function(){return view('streaming.region10');})->name('region10');
Route::get('AjaxRegion10', 'streamController@region10');


//REPORT
Route::get('reportYT', 'graphController@reportYT')->name('reportYT');
Route::get('reportSP', 'graphController@reportSP')->name('reportSP');
Route::get('reportAPP', 'graphController@reportAPP')->name('reportAPP');
Route::get('reportBOOM', 'graphController@reportBOOM')->name('reportBOOM');
Route::get('reportMDN', 'graphController@reportMDN')->name('reportMDN');
Route::get('reportDZZ', 'graphController@reportDZZ')->name('reportDZZ');



//Streaming


//** __________________________________________ADMIN_____________________________________________ **//

Route::group([ 'prefix' => 'admin'], function(){ 

    Route::get('/index_admin','adminController@index_admin')->name('index_admin');
    Route::get('/logout','adminController@logout')->name('logout');

        Route::get('/artists', 'adminController@artists')->name('artistsList');
        Route::get('/approve/{id}', 'adminController@approve')->name('approve');
        Route::get('/restrict/{id}', 'adminController@restrict')->name('restrict');
        Route::get('/del_artist/{id}', 'adminController@del_artist')->name('del_artist');
      
        Route::get('/users', 'adminController@users')->name('users');   
        Route::get('/songs', 'adminController@songs')->name('songs');         
        Route::post('/adminLogin', 'adminController@adminLogin')->name('adminLogin');
        Route::get('/reviews', function () {
        return view('admin.reviews');
        })->name('reviews');

    Route::get('forgot/{remail}', 'adminController@forgot')->name('forgot');
    Route::post('send_reset_email', 'adminController@send_reset_email')->name('send_reset_email');
    Route::post('reset/{remail}', 'adminController@reset')->name('reset');

      
        //Route::get('/', function () {return view('admin.login');})->name('login');
       

});
 Route::get('admin/login', function () {return view('admin.login');})->name('loginA');
//** __________________________________________ADMIN_____________________________________________ **//


 
// Clear Config

Route::get('/clear-config', function() {
    $exitCode = Artisan::call('config:clear');
    return "config clear";

});


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return "config clear";

});
 
 
 
