<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Goutte\Client;
use File;
use Exception;
use Http;
use  App\Models\User;
use  App\Models\streaming;
class streamController extends Controller
{

private $results=array();
private $RegSongs=array();
private $RegSongs2=array();

//APPLE
public $merge =array();
public $merge2 =array();
public $name =array();
public $name2 =array();
public $artist =array();
public $artist2 =array();
public $duration =array();
public $duration2 =array();
public $regions2 = array();

public $i=0, $j=0, $cnt2=0, $cnt=1, $k=0;
 
public function insert_id(Request $req)
{ 
    $art=User::where('email', Session::get('logged'))->first();$art_id=$art->id;

    if($req->type == "YouTube Channel")
    {
        streaming::where('user_id',$art_id)->update([
        'youtube_id' => $req->id,
        'youtube_regid' => $req->regid
        ]);
        return redirect('youtube');
    }
    if($req->type == "Spotify Artist")
    {
        streaming::where('user_id',$art_id)->update([
        'spotify_id' => $req->id,
        'spotify_regid' => $req->regid
        ]);
        return redirect('spotify');
    }
     if($req->type == "Deezer Artist")
    {
        streaming::where('user_id',$art_id)->update([
        'deezer_id' => $req->id,
        'deezer_regid' => $req->regid
        ]);
        return redirect('deezer');
    }
     if($req->type == "Apple Artist")
    {
        streaming::where('user_id',$art_id)->update([
        'apple_id' => $req->id,
        'apple_regid' => $req->regid
        ]);
        return redirect('apple');
    }
     if($req->type == "Boomplay Artist")
    {
        streaming::where('user_id',$art_id)->update([
        'boomplay_id' => $req->id,
        'boomplay_regid' => $req->regid
        ]);
        return redirect('boomplay');
    }
     if($req->type == "Mdundo Artist")
    {
        streaming::where('user_id',$art_id)->update([
        'mdundo_id' => $req->id,
        'mdundo_regid' => $req->regid
        ]);
        return redirect('mdundo');
    }
}

public function update_id($type)
{  $thisUser=User::where('email', Session::get('logged'))->first();
   $id=$thisUser->id; $platform = $type;   
   return view('streaming.insert_id',compact('platform'));
}



 
 

//DEEZER
    public function getDeezer() { //return view('home'); 

$thisUser=User::where('email', Session::get('logged'))->first();
$id=$thisUser->id; $platform = 'Deezer Artist';
$stream=Streaming::where('user_id', $id)->first(); $platform_id = $stream->deezer_id;
if($platform_id == null) return view('streaming.insert_id',compact('platform'));
//CHECK ID

    $client = new Client();
        
    //TOP REGION
    $url = 'https://www.deezer.com/us/playlist/1362509215';
    $data= $client->request('GET', $url);
    $region=$data->filter('.ellipsis') //->text(); return $region;
    ->each(function($item){      
        $this->regions[$this->j] = $item->text(); $this->j++; //echo ' // '.$item->text();
     $this->cnt++;        
    });
    

   
    foreach($this->regions as $schl) {  
       $this->RegSongs[$this->i][$this->k]=$schl;

        // echo $schl.' ';
         $this->cnt2++; $this->k++; 
        if($this->cnt2%4==0) { $this->i++; $this->k=0; //echo '<br>'; 
    }
         }


          //TOP TRACKS
         $url = 'https://www.deezer.com/us/artist/'.$platform_id; //11431670';
    $data2= $client->request('GET', $url); ;
    $region2=$data2->filter('body') ->text();
    $this->RegSongs2 = $this->strpos_alls($region2, "ALB_TITLE"); 
    
//FANS
    $url2 = 'https://www.deezer.com/us/artist/'.$platform_id;
    $data2= $client->request('GET', $url2); 
    $fans=$data2->text();  $fan=  substr($fans,0,300);
    $fan = (int) filter_var($fan, FILTER_SANITIZE_NUMBER_INT); 

    return view('streaming.deezer', ['school' => $this->RegSongs, 'school2' => $this->RegSongs2, 'fan' => $fan] );

//Ex: 
//$this->schools[$this->j] = $item->attr('href'); $this->j++;  
//$all=$data2->filter('.project_data > li')->each(function($items){ $this->results[$this->i] = $items->text(); }

}
//DEEZER END



//YOUTUBE
 public function youtube() { 


// _______________________________________ GOOGLE access token
//    if (isset($_GET['code'])) {
//    // try to get an access token
//    $code = $_GET['code'];

// //POST format
// $curl=curl_init();
// curl_setopt_array($curl, array(
// CURLOPT_URL=> 'https://accounts.google.com/o/oauth2/token',
// CURLOPT_RETURNTRANSFER=> TRUE,
// CURLOPT_ENCODING=> '',
// CURLOPT_MAXREDIRS=> 10,
// CURLOPT_TIMEOUT=> 30,
// CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
// CURLOPT_CUSTOMREQUEST=> 'POST',
// CURLOPT_POSTFIELDS=>json_encode([
//         "code" => $code,
//         "client_id" => '578068797874-bhv1egn4tsiljt1g71gakmrkop4t2fkg.apps.googleusercontent.com',
//         "client_secret" => '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',
//         "redirect_uri" => 'http://localhost/laravel_projects/radio/public/youtube',
//         "grant_type" => "authorization_code"
// ]),

// CURLOPT_HTTPHEADER=> array(
// 'content-type:application/json',

// ),
// ));

// $response=curl_exec($curl); //return $response;
// $response=json_decode($response,true);
// $access_token= $response['access_token']; 




// } else {

//     $url = "https://accounts.google.com/o/oauth2/auth";

//     $params = array(
//         "response_type" => "code",
//         "client_id" => '578068797874-bhv1egn4tsiljt1g71gakmrkop4t2fkg.apps.googleusercontent.com',
//         "redirect_uri" => 'http://localhost/laravel_projects/radio/public/youtube',
//         "scope" => "https://www.googleapis.com/auth/yt-analytics.readonly"
//     );

//     $request_to = $url . '?' . http_build_query($params);

//    header("Location: ".$request_to);
// die(); //return 'An error happened'. $request_to;
// };

// ___________________________________ GOOGLE access token

// //Channel Report
//   $apiKey="AIzaSyAEHR7KwdG4hXr4lc2FZd8ojcBLGSpD0Ik";
//   $base_url='https://youtubeanalytics.googleapis.com/v2/reports/';
//   $channel_id='UCxnUFZ_e7aJFw3Tm8mA7pvQ';
//   $maxRes = 10;
//   $api_url = $base_url.'?dimensions=month&endDate=2022-07-01&startDate=2022-06-01&ids=channel==MINE&metrics=views,comments,likes,dislikes,estimatedMinutesWatched,averageViewDuration'; 

// $curl=curl_init();
// curl_setopt_array($curl, array(
// CURLOPT_URL=> $api_url,
// CURLOPT_RETURNTRANSFER=> TRUE,
// CURLOPT_ENCODING=> '',
// CURLOPT_MAXREDIRS=> 10,
// CURLOPT_TIMEOUT=> 30,
// CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
// CURLOPT_CUSTOMREQUEST=> 'GET',
// CURLOPT_HTTPHEADER=> array(
// 'content-type:application/json',
// 'Authorization:Bearer '.$access_token
// ),
// ));


// $response=curl_exec($curl);
// $response=json_decode($response,true);
// echo '<pre>';print_r($response);echo '<pre>';

// $error=curl_error($curl);
// if($error) echo $error;
  
//    echo '<pre>'; print_r($response); echo '<pre>'; return; 

// Channel Report

$thisUser=User::where('email', Session::get('logged'))->first();
$id=$thisUser->id; $platform = 'YouTube Channel';
$stream=Streaming::where('user_id', $id)->first(); $platform_id = $stream->youtube_id;
$uuid = $stream->youtube_uuid;
if($platform_id == null) return view('streaming.insert_id',compact('platform'));


//**Top videos by view in the Channel
  $apiKey="AIzaSyAEHR7KwdG4hXr4lc2FZd8ojcBLGSpD0Ik";
  $base_url="https://www.googleapis.com/youtube/v3/";
  $channel_id= $platform_id; //'UCxnUFZ_e7aJFw3Tm8mA7pvQ';
  $maxRes = 10;
  $api_url = $base_url.'search?part=snippet&order=viewCount&channelId='.$channel_id.'&maxResults='.$maxRes.'&key='.$apiKey;
  
  $response = Http::get($api_url);
  $response=json_decode($response,true); 

   $tracks=array(); $i=0;
   foreach($response['items'] as $track){
    $tracks[$i]['title']=$track['snippet']['title'];
    $tracks[$i]['image']=$track['snippet']['thumbnails']['medium']['url']; $i++;
}
 //echo '<pre>'; print_r($tracks); echo '<pre>'; return; 

//**Top videos by view in the Channel
   


//**Subscriber & Total View
  
  $api_url = $base_url.'channels?&part=statistics&id='.$channel_id.'&maxRes='.$maxRes.'&key='.$apiKey;

  $response = Http::get($api_url);
  $response=json_decode($response,true);
 $viewCount=$response['items'][0]['statistics']['viewCount'];
 $subscribers=$response['items'][0]['statistics']['subscriberCount'];
 $videoCount=$response['items'][0]['statistics']['viewCount'];
  // echo '<pre>'; print_r($response); echo '<pre>'; return; 

//**Subscriber & Total View



// **Latest Monthly Views
 //uuid = ca22091a-3c00-11e9-974f-549f35141000
  $artist_id='7KY9NaOVRmptl8vlpVomi6';
  $base_url='https://sandbox.api.soundcharts.com/api/v2/artist/'.$uuid.'/streaming/youtube/views/2020/10';

$curl=curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL=> $base_url,
CURLOPT_RETURNTRANSFER=> TRUE,
CURLOPT_ENCODING=> '',
CURLOPT_MAXREDIRS=> 10,
CURLOPT_TIMEOUT=> 30,
CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST=> 'GET',
CURLOPT_HTTPHEADER=> array(
'content-type:application/json',
'x-app-id:soundcharts',
'x-api-key:soundcharts'
),
));


$response=curl_exec($curl); 
$response=json_decode($response,true);

$error=curl_error($curl);
if($error) echo $error;
  // echo '<pre>'; print_r($response); echo '<pre>'; return; 

// $views=array();$i=0;
// foreach($response['items'] as $data){
// $views[$i]['date'] = $data['date'];
// $views[$i]['view'] = $data['value']; $i++;
// }
 $views=$response['items'][0]['value'];
// **Latest Monthly Views
   

   //**Top in the Region
  $apiKey="AIzaSyAEHR7KwdG4hXr4lc2FZd8ojcBLGSpD0Ik";
  $base_url="https://www.googleapis.com/youtube/v3/";
  $channel_id= $platform_id; //'UCxnUFZ_e7aJFw3Tm8mA7pvQ';
  $maxRes = 10;

  $api_url = $base_url.'videos?part=snippet&chart=mostPopular&regionCode=KE&videoCategoryId=10&maxResults='.$maxRes.'&key='.$apiKey;
  
  $response = Http::get($api_url);
  $response=json_decode($response,true);
   //echo '<pre>'; print_r($response->body()); echo '<pre>'; return;

   $tracks_reg=array(); $i=0;
   foreach($response['items'] as $track){
    $tracks_reg[$i]['title']=$track['snippet']['title'];
    $tracks_reg[$i]['image']=$track['snippet']['thumbnails']['medium']['url']; $i++;
}
 //echo '<pre>'; print_r($tracks_reg); echo '<pre>'; return;  

//**Top in the Region
   
    
    return view('streaming.youtube', compact('tracks','tracks_reg','viewCount','subscribers','videoCount','views') );

}

//YOUTUBE END

   

//SPOTIFY
 public function spotify() { 

$thisUser=User::where('email', Session::get('logged'))->first();
$id=$thisUser->id; $platform = 'Spotify Artist';
$stream=Streaming::where('user_id', $id)->first(); $platform_id = $stream->spotify_id;
$uuid = $stream->spotify_uuid;
if($platform_id == null) return view('streaming.insert_id',compact('platform'));
//CHECK ID

    
   //_______________________________________ GOOGLE access token

   if (isset($_GET['code'])) { 
   // try to get an access token
   $code = $_GET['code']; 
   $secret=base64_encode('0aadf46389f04aef84cd7a910fb48b5e:fb87c4a6961f43e3a63a39ba8f60c4c0');
   $params=array(
        "grant_type" => "client_credentials",
        "code" => $code,
        //"client_id" => '578068797874-bhv1egn4tsiljt1g71gakmrkop4t2fkg.apps.googleusercontent.com',
        //"client_secret" => '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',
        "redirect_uri" => 'http://localhost/laravel_projects/radio/public/spotify'
   );

//POST format
$curl=curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL=> 'https://accounts.spotify.com/api/token',
CURLOPT_RETURNTRANSFER=> TRUE,
CURLOPT_ENCODING=> '',
CURLOPT_MAXREDIRS=> 10,
CURLOPT_TIMEOUT=> 30,
CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST=> 'POST',
CURLOPT_POSTFIELDS=>http_build_query($params),

CURLOPT_HTTPHEADER=> array(
'content-type:application/x-www-form-urlencoded',
 'Authorization: Basic '.$secret

),
));

$response=curl_exec($curl); //return $response;
$response=json_decode($response,true);
$access_token= $response['access_token']; 
//return $access_token;



} else {

    $url = "https://accounts.spotify.com/authorize";
    $params = array(
        "response_type" => "code",
        "client_id" => '0aadf46389f04aef84cd7a910fb48b5e',
        "redirect_uri" => 'http://localhost/laravel_projects/radio/public/spotify',
        "state" => "random_state"
    );

    $request_to = $url . '?' . http_build_query($params);

    header("Location: ".$request_to);
die(); //return 'An error happened'. $request_to;
};

//___________________________________ GOOGLE access token

// Monthly Listeners
  //$uuid='11e81bcc-9c1c-ce38-b96b-a0369fe50396';
  $artist_id='7KY9NaOVRmptl8vlpVomi6';
  $base_url='https://sandbox.api.soundcharts.com/api/v2/artist/'.$uuid.'/streaming/spotify/listeners/2020/10';
  //$api_url = $base_url.'?id='.$artist_id.'&country=ES'; 

$curl=curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL=> $base_url,
CURLOPT_RETURNTRANSFER=> TRUE,
CURLOPT_ENCODING=> '',
CURLOPT_MAXREDIRS=> 10,
CURLOPT_TIMEOUT=> 30,
CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST=> 'GET',
CURLOPT_HTTPHEADER=> array(
'content-type:application/json',
'x-app-id:soundcharts',
'x-api-key:soundcharts'
),
));


$response=curl_exec($curl); 
$response=json_decode($response,true);

$error=curl_error($curl);
if($error) echo $error;
  // echo '<pre>'; print_r($response); echo '<pre>'; return; 

 $listeners=$response['items'][0]['value'];
//Monthly Listeners



// Artist Top Tracks

  $artist_id= $platform_id; //'0TnOYISbd1XYRBk9myaseg';
  $base_url='https://api.spotify.com/v1/artists/'.$artist_id.'/top-tracks?country=ES';
  
  //$api_url = $base_url.'?id='.$artist_id.'&country=ES'; 

$curl=curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL=> $base_url,
CURLOPT_RETURNTRANSFER=> TRUE,
CURLOPT_ENCODING=> '',
CURLOPT_MAXREDIRS=> 10,
CURLOPT_TIMEOUT=> 30,
CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST=> 'GET',
CURLOPT_HTTPHEADER=> array(
'content-type:application/json',
'Authorization:Bearer '.$access_token
),
));


$response=curl_exec($curl);
$response=json_decode($response,true);

$error=curl_error($curl);
if($error) echo $error; 
  
   //echo '<pre>'; print_r($response); echo '<pre>'; return; 

$tracks=array();
$i=0;
foreach($response['tracks'] as $track){
    $tracks[$i]['duration']=$track['duration_ms']/1000;
    $tracks[$i]['album']=$track['album']['name'];
    $tracks[$i]['song']=$track['name']; $i++;
}
//echo '<pre>'; print_r($tracks); echo '<pre>'; return; 

//Artist Top Tracks

  return view('streaming.spotify', compact('tracks','listeners') );

}
//SPOTIFY END



//APPLE
 public function apple() {  

$thisUser=User::where('email', Session::get('logged'))->first();
$id=$thisUser->id; $platform = 'Apple Artist';
$stream=Streaming::where('user_id', $id)->first(); $platform_id = $stream->apple_id;
if($platform_id == null) return view('streaming.insert_id',compact('platform'));
//CHECK ID

   
    $client = new Client();
    $this->i=0; $this->j=0; $this->k=0;    

    //Top 10 in the region
    $url = 'https://music.apple.com/us/playlist/top-100-kenya/pl.0b36ea82865d4adeb9d1d62207aab172';
    $data= $client->request('GET', $url);

    //____SONG NAME____
    $region=$data->filter('.songs-list-row__song-name') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->name[$this->j] = $item->text(); $this->j++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    //____ARTIST
    
    $region2=$data->filter('.songs-list__song-link-wrapper > a') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->artist[$this->i] = $item->text(); $this->i++; 
     $this->cnt++;    
    });  
     


    //____DURATION
     
    $region3=$data->filter('.songs-list-row__length') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->duration[$this->k] = $item->text(); $this->k++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    for($b=0;$b<10;$b++)
    {
        $this->merge[$b]['title']=$this->name[$b];
        $this->merge[$b]['artist']=$this->artist[$b];
        $this->merge[$b]['duration']=$this->duration[$b];
    }
     //echo '<pre>'; print_r($this->merge); echo '<pre>'; return; 
    
    
    //Top 10 in the region


//**Top 10 songs
    $this->i=0; $this->j=0; $this->k=0;   
    $url = 'https://music.apple.com/us/artist/nyashinski/'.$platform_id.'/see-all?section=top-songs'; //1095580786
    $data2= $client->request('GET', $url);
    //____SONG NAME____
    $region=$data2->filter('.songs-list-row__song-name') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->name2[$this->j] = $item->text(); $this->j++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    //____ARTIST
    
    $region2=$data2->filter('.songs-list__song-link-wrapper > a') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->artist2[$this->i] = $item->text(); $this->i++; 
     $this->cnt++;    
    });  
     


    //____DURATION
     
    $region3=$data2->filter('.songs-list-row__length') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->duration2[$this->k] = $item->text(); $this->k++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    for($b=0;$b<10;$b++)
    {
        $this->merge2[$b]['title']=$this->name2[$b];
        $this->merge2[$b]['artist']=$this->artist2[$b];
        $this->merge2[$b]['duration']=$this->duration2[$b];
    }

//Top 10 songs


    return view('streaming.apple', ['merge' => $this->merge, 'merge2' => $this->merge2] );

}
//APPLE END




//BOOMPLAY
 public function boomplay() {  //artistName/rankingCurrent  /songNameWrap  

$thisUser=User::where('email', Session::get('logged'))->first();
$id=$thisUser->id; $platform = 'Boomplay Artist';
$stream=Streaming::where('user_id', $id)->first(); $platform_id = $stream->boomplay_id;
if($platform_id == null) return view('streaming.insert_id',compact('platform'));
//CHECK ID

    $client = new Client();
    $this->i=0; $this->j=0; $this->k=0;    

    //Top 10 in the region
    $url = 'https://www.boomplay.com/playlists/856783?from=charts';
    $data= $client->request('GET', $url);

    //____SONG NAME____
    $region=$data->filter('.songName') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->name[$this->j] = $item->text(); $this->j++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    //____ARTIST
    
    $region2=$data->filter('.artistName') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->artist[$this->i] = $item->text(); $this->i++; 
     $this->cnt++;    
    });  
     


    //____DURATION
     
    $region3=$data->filter('time') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->duration[$this->k] = $item->text(); $this->k++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    for($b=1;$b<11;$b++)
    {
        $this->merge[$b]['title']=$this->name[$b];
        $this->merge[$b]['artist']=$this->artist[$b];
        $this->merge[$b]['duration']=$this->duration[$b];
    }
    // echo '<pre>'; print_r($this->merge); echo '<pre>'; return; 
    
    
    //Top 10 in the region


//**Top 10 songs
    $this->i=0; $this->j=0; $this->k=0;   
    $url = 'https://www.boomplay.com/artists/'.$platform_id; //70177
    $data2= $client->request('GET', $url);
    //____SONG NAME____
    $region=$data2->filter('.songNameWrap') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->name2[$this->j] = $item->text(); $this->j++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    //____ARTIST
    
    $region2=$data2->filter('.artistName') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->artist2[$this->i] = $item->text(); $this->i++; 
     $this->cnt++;    
    });  
     


    //____DURATION
     
    $region3=$data2->filter('time') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->duration2[$this->k] = $item->text(); $this->k++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    for($b=1;$b<11;$b++)
    {
        $this->merge2[$b]['title']=$this->name2[$b];
        $this->merge2[$b]['artist']=$this->artist2[$b];
        $this->merge2[$b]['duration']=$this->duration2[$b];
    }
//echo '<pre>'; print_r($this->merge2); echo '<pre>'; return; 
//Top 10 songs

//**RANK & LIKES
    $url = 'https://www.boomplay.com/artists/70177';
    $data3= $client->request('GET', $url);
    $currentRank=$data3->filter('.rankingCurrent')->text();
    $currentAll=$data3->filter('.rankingAllTime')->text();
    $favorite=$data3->filter('.favorite_event')->text(); 
    


    return view('streaming.boomplay', ['cRank'=>$currentRank,'aRank'=>$currentAll,'favorite'=>$favorite,'merge' => $this->merge, 'merge2' => $this->merge2] );


}
//BOOMPLAY END




//MDUNDO
 public function mdundo() {

$thisUser=User::where('email', Session::get('logged'))->first();
$id=$thisUser->id; $platform = 'Mdundo Artist';
$stream=Streaming::where('user_id', $id)->first(); $platform_id = $stream->mdundo_id;
if($platform_id == null) return view('streaming.insert_id',compact('platform'));
//CHECK ID

    $client = new Client();
    $this->i=0; $this->j=0; $this->k=0;    

    //Top 10 in the region
    $url = 'https://mdundo.com/best/ke';
    $data= $client->request('GET', $url);

    //____SONG NAME____
    $region=$data->filter('.song-title') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->name[$this->j] = $item->text(); $this->j++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    //____ARTIST
    
    $region2=$data->filter('.song-author') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->artist[$this->i] = $item->text(); $this->i++; 
     $this->cnt++;    
    });  
     


    //____DURATION
     
    $region3=$data->filter('.stream_off') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->duration[$this->k] = $item->text(); $this->k++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    for($b=0;$b<10;$b++)
    {
        $this->merge[$b]['title']=$this->name[$b];
        $this->merge[$b]['artist']=$this->artist[$b];
        $this->merge[$b]['duration']=$this->duration[$b];
    }
    // echo '<pre>'; print_r($this->merge); echo '<pre>'; return; 
    
    
    //Top 10 in the region


//**Top 10 songs
    $this->i=0; $this->j=0; $this->k=0;   
    $url = 'https://mdundo.com/a/'.$platform_id; //37921;
    $data2= $client->request('GET', $url);
    //____SONG NAME____
    $region=$data2->filter('.song-title') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->name2[$this->j] = $item->text(); $this->j++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    //____ARTIST
    
    $region2=$data2->filter('.song-author') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->artist2[$this->i] = $item->text(); $this->i++; 
     $this->cnt++;    
    });  
     


    //____DURATION
     
    $region3=$data2->filter('.stream_off') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->duration2[$this->k] = $item->text(); $this->k++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    for($b=0;$b<10;$b++)
    {
        $this->merge2[$b]['title']=$this->name2[$b];
        $this->merge2[$b]['artist']=$this->artist2[$b];
        $this->merge2[$b]['duration']=$this->duration2[$b];
    }
//echo '<pre>'; print_r($this->merge2); echo '<pre>'; return; 
//Top 10 songs

    //**RANK & LIKES
    $url = 'https://mdundo.com/a/37921';
    $data3= $client->request('GET', $url);
    $currentRank=$data3->filter('.b-description__rank')->text();
      $lis=substr($currentRank,0,strpos($currentRank,'R')-1);
      $rank=substr($currentRank,strpos($currentRank,'R'));
   
    


    return view('streaming.mdundo', ['lis'=>$lis, 'rank'=>$rank, 'merge' => $this->merge, 'merge2' => $this->merge2] );


}
//MDUNDO END   





//OVERALL 10
public $dzz_r=array();
public $dzz_reg=array();
public $dzz_tops=array(); 


//APPLE
public $merge_app =array();
public $merge2_app =array();
public $name_app =array();
public $name2_app =array();
public $artist_app =array();
public $artist2_app =array();
public $duration_app =array();
public $duration2_app =array();
//Boom
public $merge_boom =array();
public $merge2_boom =array();
public $name_boom =array();
public $name2_boom =array();
public $artist_boom =array();
public $artist2_boom =array();
public $duration_boom =array();
public $duration2_boom =array();
//MDN
public $merge_mdn =array();
public $merge2_mdn =array();
public $name_mdn =array();
public $name2_mdn =array();
public $artist_mdn =array();
public $artist2_mdn =array();
public $duration_mdn =array();
public $duration2_mdn =array();



    public function overall10() { 
        $thisUser=User::where('email', Session::get('logged'))->first();
        $id=$thisUser->id; $platform = 'Deezer Artist';
        $stream=Streaming::where('user_id', $id)->first(); 
        //if($platform_id == null) return view('streaming.insert_id',compact('platform'));
        //CHECK ID


//**DZZ
    
    $client = new Client();
        
$platform_id=$stream->deezer_id;
    
//TOP TRACKS
    $url = 'https://www.deezer.com/us/artist/'.$platform_id; //11431670';
    $data2= $client->request('GET', $url); ;
    $region2=$data2->filter('body') ->text();
    $this->dzz_tops = $this->strpos_alls($region2, "ALB_TITLE"); 
    
//**DZZ


//**YT
 $tracks=array(); $i=0;
//Top videos by view in the Channel
  $apiKey="AIzaSyAEHR7KwdG4hXr4lc2FZd8ojcBLGSpD0Ik";
  $base_url="https://www.googleapis.com/youtube/v3/";
  $channel_id= $stream->youtube_id; //'UCxnUFZ_e7aJFw3Tm8mA7pvQ';
  $maxRes = 10;
  $api_url = $base_url.'search?part=snippet&order=viewCount&channelId='.$channel_id.'&maxResults='.$maxRes.'&key='.$apiKey;
  
  $response = Http::get($api_url);
  $response=json_decode($response,true); 

   $tracks=array(); $i=0;
   foreach($response['items'] as $track){
    $tracks[$i]['title']=$track['snippet']['title'];
    $tracks[$i]['image']=$track['snippet']['thumbnails']['medium']['url']; $i++;
}
 //echo '<pre>'; print_r($tracks); echo '<pre>'; return; 

//Top videos by view in the Channel
 

//**YT  



//**APP  
  $this->i=0; $this->j=0; $this->k=0;    


//Top 10 songs
    $platform_id=$stream->apple_id;
    $this->i=0; $this->j=0; $this->k=0;   
    $url = 'https://music.apple.com/us/artist/nyashinski/'.$platform_id.'/see-all?section=top-songs'; //1095580786
    $data2= $client->request('GET', $url);
    //____SONG NAME____
    $region=$data2->filter('.songs-list-row__song-name') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->name2_app[$this->j] = $item->text(); $this->j++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    //____ARTIST
    
    $region2=$data2->filter('.songs-list__song-link-wrapper > a') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->artist2_app[$this->i] = $item->text(); $this->i++; 
     $this->cnt++;    
    });  
     


    //____DURATION
     
    $region3=$data2->filter('.songs-list-row__length') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->duration2_app[$this->k] = $item->text(); $this->k++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    for($b=0;$b<10;$b++)
    {
        $this->merge2_app[$b]['title']=$this->name2_app[$b];
        $this->merge2_app[$b]['artist']=$this->artist2_app[$b];
        $this->merge2_app[$b]['duration']=$this->duration2_app[$b];
    }

//Top 10 songs


//**APP



//**Boom  
 
//Top 10 songs
    $this->i=0; $this->j=0; $this->k=0;
    $platform_id=$stream->boomplay_id;   
    $url = 'https://www.boomplay.com/artists/'.$platform_id; //70177
    $data2= $client->request('GET', $url);
    //____SONG NAME____
    $region=$data2->filter('.songNameWrap') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->name2_boom[$this->j] = $item->text(); $this->j++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    //____ARTIST
    
    $region2=$data2->filter('.artistName') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->artist2_boom[$this->i] = $item->text(); $this->i++; 
     $this->cnt++;    
    });  
     


    //____DURATION
     
    $region3=$data2->filter('time') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->duration2_boom[$this->k] = $item->text(); $this->k++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    for($b=1;$b<11;$b++)
    {
        $this->merge2_boom[$b]['title']=$this->name2_boom[$b];
        $this->merge2_boom[$b]['artist']=$this->artist2_boom[$b];
        $this->merge2_boom[$b]['duration']=$this->duration2_boom[$b];
    }
//echo '<pre>'; print_r($this->merge2); echo '<pre>'; return; 
//Top 10 songs


    


//**Boom  




//**MDN  

//**Top 10 songs
    $platform_id=$stream->mdundo_id;
    $this->i=0; $this->j=0; $this->k=0;   
    $url = 'https://mdundo.com/a/'.$platform_id; //37921;
    $data2= $client->request('GET', $url);
    //____SONG NAME____
    $region=$data2->filter('.song-title') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->name2_mdn[$this->j] = $item->text(); $this->j++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    //____ARTIST
    
    $region2=$data2->filter('.song-author') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->artist2_mdn[$this->i] = $item->text(); $this->i++; 
     $this->cnt++;    
    });  
     


    //____DURATION
     
    $region3=$data2->filter('.stream_off') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->duration2_mdn[$this->k] = $item->text(); $this->k++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    for($b=0;$b<10;$b++)
    {
        $this->merge2_mdn[$b]['title']=ucwords(strtolower($this->name2_mdn[$b]));
        $this->merge2_mdn[$b]['artist']=$this->artist2_mdn[$b];
        $this->merge2_mdn[$b]['duration']=$this->duration2_mdn[$b];
    }
//echo '<pre>'; print_r($this->merge2); echo '<pre>'; return; 
//Top 10 songs

//**MDN  
   

//$$$$ COMBINED $$$$

   $combined=array();$x=0;$mark=10;
   foreach($this->dzz_tops as $single)
   { if($mark>0){
    $combined[$x]['title'] = $single; $combined[$x]['artist'] = $thisUser->stage_name;
    $combined[$x]['marks'] = $mark; $x++; $mark--;
   }}

   $mark=10;
   foreach($tracks as $single)
   {
    $combined[$x]['title'] = $single['title']; $combined[$x]['artist'] = $thisUser->stage_name;
    $combined[$x]['marks'] = $mark; $x++; $mark--;
   }

   $mark=10;
   foreach($this->merge2_app as $single)
   {
    $combined[$x]['title'] = $single['title']; $combined[$x]['artist'] = $single['artist'];
    $combined[$x]['marks'] = $mark; $x++; $mark--;
   }

   $mark=10;
   foreach($this->merge2_boom as $single)
   {
    $combined[$x]['title'] = $single['title']; $combined[$x]['artist'] = $single['artist'];
    $combined[$x]['marks'] = $mark; $x++; $mark--;
   }

   $mark=10;
   foreach($this->merge2_mdn as $single)
   {
    $combined[$x]['title'] = $single['title']; $combined[$x]['artist'] = $single['artist'];
    $combined[$x]['marks'] = $mark; $x++; $mark--;
   }

//MATH 
$finalArray=array(); $sortedList=array();$i=0; $finalArtists=array();
foreach($combined as $song) { 

       
        if (!isset($finalArray[$song['title'] ]  ))
        {
        // Init $newArray[A] for example
            $finalArray[$song['title']]= $song['marks'];
            $finalArtists[$song['title']] = $song['artist'];

        }
       else
       {
       $finalArray[$song['title']] += $song['marks'];
       $finalArtists[$song['title']] = $song['artist'];
        // Add the right 'count' to $newArray[A]
        }
        
    
}

    foreach($finalArray as $title => $marks)
    {   
        foreach($finalArtists as $t => $art)
        if($title == $t) $sortedList[$i]['artist'] = $art;

        $sortedList[$i]['title'] = $title;
        $sortedList[$i]['marks'] = $marks; $i++;
    }  
    
     usort($sortedList, function($a, $b){
     return $b['marks'] - $a['marks'];
 });

    return response()->json(['list' => $sortedList]);
    //echo '<pre>';  print_r($sortedList); echo '<pre>'; exit;
   // "<br><br>__________________________________________YouTube =".print_r($tracks).
   // "<br><br>__________________________________________Apple =".print_r($this->merge2_app).
   // "<br><br>__________________________________________Boomplay =".print_r($this->merge2_boom).
   // "<br><br>__________________________________________ Mdundo =".print_r($this->merge2_mdn);
    

//**MDN  



//**SP    

//**SP    

    return view('streaming.overall10', ['school' => $this->RegSongs, 'school2' => $this->RegSongs2, 'fan' => $fan] );


}

//OVERALL 10




//_____AllRegions__________

 public function region10() { 
        $thisUser=User::where('email', Session::get('logged'))->first();
        $id=$thisUser->id; $platform = 'Deezer Artist';
        $stream=Streaming::where('user_id', $id)->first(); 
        //if($platform_id == null) return view('streaming.insert_id',compact('platform'));
        //CHECK ID


//**DZZ
    
    $client = new Client();
        
    //TOP REGION
    $platform_id=$stream->deezer_id;
    $url = 'https://www.deezer.com/us/playlist/1362509215';
    $data= $client->request('GET', $url);
    $region=$data->filter('.ellipsis') //->text(); return $region;
    ->each(function($item){      
        $this->dzz_r[$this->j] = $item->text(); $this->j++; //echo ' // '.$item->text();
     $this->cnt++;        
    });
    

   
    foreach($this->dzz_r as $schl) {  
       $this->dzz_reg[$this->i][$this->k]=$schl;

        // echo $schl.' ';
         $this->cnt2++; $this->k++; 
        if($this->cnt2%4==0) { $this->i++; $this->k=0; //echo '<br>'; 
    }
         }
    
//**DZZ


//**YT
 
  $tracks_reg=array(); $i=0;

  //Top in the Region 
  $apiKey="AIzaSyAEHR7KwdG4hXr4lc2FZd8ojcBLGSpD0Ik";
  $base_url="https://www.googleapis.com/youtube/v3/";
  $channel_id= $platform_id; //'UCxnUFZ_e7aJFw3Tm8mA7pvQ';
  $maxRes = 10;

  $api_url = $base_url.'videos?part=snippet&chart=mostPopular&regionCode=KE&videoCategoryId=10&maxResults='.$maxRes.'&key='.$apiKey;
  
  $response = Http::get($api_url);
  $response=json_decode($response,true);
   //echo '<pre>'; print_r($response->body()); echo '<pre>'; return;

   $tracks_reg=array(); $i=0;
   foreach($response['items'] as $track){
    $tracks_reg[$i]['title']=$track['snippet']['title'];
    $tracks_reg[$i]['image']=$track['snippet']['thumbnails']['medium']['url']; $i++;
}
 //echo '<pre>'; print_r($tracks_reg); echo '<pre>'; return;  

//Top in the Region

//**YT  



//**APP  
  $this->i=0; $this->j=0; $this->k=0;    

    //Top 10 in the region
    $url = 'https://music.apple.com/us/playlist/top-100-kenya/pl.0b36ea82865d4adeb9d1d62207aab172';
    $data= $client->request('GET', $url);

    //____SONG NAME____
    $region=$data->filter('.songs-list-row__song-name') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->name_app[$this->j] = $item->text(); $this->j++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    //____ARTIST
    
    $region2=$data->filter('.songs-list__song-link-wrapper > a') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->artist_app[$this->i] = $item->text(); $this->i++; 
     $this->cnt++;    
    });  
     


    //____DURATION
     
    $region3=$data->filter('.songs-list-row__length') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->duration_app[$this->k] = $item->text(); $this->k++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    for($b=0;$b<10;$b++)
    {
        $this->merge_app[$b]['title']=$this->name_app[$b];
        $this->merge_app[$b]['artist']=$this->artist_app[$b];
        $this->merge_app[$b]['duration']=$this->duration_app[$b];
    }
     //echo '<pre>'; print_r($this->merge); echo '<pre>'; return; 
    
    
    //Top 10 in the region


//**APP



//**Boom  
$this->i=0; $this->j=0; $this->k=0;    

    //Top 10 in the region
    $url = 'https://www.boomplay.com/playlists/856783?from=charts';
    $data= $client->request('GET', $url);

    //____SONG NAME____
    $region=$data->filter('.songName') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->name_boom[$this->j] = $item->text(); $this->j++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    //____ARTIST
    
    $region2=$data->filter('.artistName') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->artist_boom[$this->i] = $item->text(); $this->i++; 
     $this->cnt++;    
    });  
     


    //____DURATION
     
    $region3=$data->filter('time') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->duration_boom[$this->k] = $item->text(); $this->k++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    for($b=1;$b<11;$b++)
    {
        $this->merge_boom[$b]['title']=$this->name_boom[$b];
        $this->merge_boom[$b]['artist']=$this->artist_boom[$b];
        $this->merge_boom[$b]['duration']=$this->duration_boom[$b];
    }
    // echo '<pre>'; print_r($this->merge); echo '<pre>'; return; 
    
    
    //Top 10 in the region


//**Boom  




//**MDN  
$this->i=0; $this->j=0; $this->k=0;    

    //Top 10 in the region
    $url = 'https://mdundo.com/best/ke';
    $data= $client->request('GET', $url);

    //____SONG NAME____
    $region=$data->filter('.song-title') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->name_mdn[$this->j] = $item->text(); $this->j++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    //____ARTIST
    
    $region2=$data->filter('.song-author') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->artist_mdn[$this->i] = $item->text(); $this->i++; 
     $this->cnt++;    
    });  
     


    //____DURATION
     
    $region3=$data->filter('.stream_off') ////songs-list-row__length//songs-list__song-link-wrapper
    ->each(function($item){      
    $this->duration_mdn[$this->k] = $item->text(); $this->k++; 
     $this->cnt++;  if($this->cnt>10) return;      
    }); 

    for($b=0;$b<10;$b++)
    {
        $this->merge_mdn[$b]['title']=$this->name_mdn[$b];
        $this->merge_mdn[$b]['artist']=$this->artist_mdn[$b];
        $this->merge_mdn[$b]['duration']=$this->duration_mdn[$b];
    }
    // echo '<pre>'; print_r($this->merge); echo '<pre>'; return; 
    
    
    //Top 10 in the region


//COMBINED
   $combined=array();$x=0;$mark=10;
   foreach($this->dzz_reg as $single)
   { if($mark>0){ //$temp = explode(',',$single['title']);
    $combined[$x]['title'] = $single[0]; $combined[$x]['artist'] = $single[1];
    $combined[$x]['marks'] = $mark; $x++; $mark--;
   }}

   $mark=10;
   foreach($tracks_reg as $single)
   {
    $combined[$x]['title'] = $single['title'];
    $a=explode('-',$single['title']); $combined[$x]['artist'] = $a[0];
    $combined[$x]['marks'] = $mark; $x++; $mark--;
   }

   $mark=10;
   foreach($this->merge_app as $single)
   {
    $combined[$x]['title'] = $single['title']; $combined[$x]['artist'] = $single['artist'];
    $combined[$x]['marks'] = $mark; $x++; $mark--;
   }

   $mark=10;
   foreach($this->merge_boom as $single)
   {
    $combined[$x]['title'] = $single['title'];  $combined[$x]['artist'] = $single['artist'];
    $combined[$x]['marks'] = $mark; $x++; $mark--;
   }

   $mark=10;
   foreach($this->merge_mdn as $single)
   {
    $combined[$x]['title'] = $single['title'];  $combined[$x]['artist'] = $single['artist'];
    $combined[$x]['marks'] = $mark; $x++; $mark--;
   }

//MATH 
$finalArray=array(); $sortedList=array();$i=0; $finalArtists=array();
foreach($combined as $song) { 

       
        if (!isset($finalArray[$song['title'] ]  ))
        {
        // Init $newArray[A] for example
            $finalArray[$song['title']]= $song['marks'];
            $finalArtists[$song['title']] = $song['artist'];

        }
       else
       {
       $finalArray[$song['title']] += $song['marks'];
       $finalArtists[$song['title']] = $song['artist'];
        // Add the right 'count' to $newArray[A]
        }
        
    
}

    foreach($finalArray as $title => $marks)
    {   
        foreach($finalArtists as $t => $art)
        if($title == $t) $sortedList[$i]['artist'] = $art;

        $sortedList[$i]['title'] = $title;
        $sortedList[$i]['marks'] = $marks; $i++;
    }  
    
     usort($sortedList, function($a, $b){
     return $b['marks'] - $a['marks'];
 });

    return response()->json(['list' => $sortedList]);
    //echo '<pre>';  print_r($sortedList); echo '<pre>'; exit;
   // "<br><br>__________________________________________YouTube =".print_r($tracks).
   // "<br><br>__________________________________________Apple =".print_r($this->merge2_app).
   // "<br><br>__________________________________________Boomplay =".print_r($this->merge2_boom).
   // "<br><br>__________________________________________ Mdundo =".print_r($this->merge2_mdn);
    

//**MDN  



//**SP    

//**SP    

    return view('streaming.overall10', ['school' => $this->RegSongs, 'school2' => $this->RegSongs2, 'fan' => $fan] );


}

//_____


/* public function getBetween($string, $start, $end){
    if (strpos($string, $start)) { // required if $start not exist in $string
        $startCharCount = strpos($string, $start) + strlen($start);
        $firstSubStr = substr($string, $startCharCount, strlen($string));
        $endCharCount = strpos($firstSubStr, $end);
        if ($endCharCount == 0) {
            $endCharCount = strlen($firstSubStr);
        }
        return substr($firstSubStr, 0, $endCharCount);
    } else {
        return '';
    }
} */



  function strpos_alls($haystack, $needle) {
    $offset = 0;
    $allpos = array();
    $exp;
    $all_title = array();
    while (($pos = strpos($haystack, $needle, $offset)) !== FALSE) {
        $offset   = $pos + 1;
        $allpos[] = $pos;
    }
    foreach($allpos as $all){
    $exp=   explode('"',substr($haystack,$all+10,35)); 
    $all_title[] = $exp[1];
}
    

    return $all_title = array_unique($all_title);
}



function curl_socialblade_api_user_stat($clientid="cli_9975099fae312a12d516e870", $token="fb2817778aab8b469824b8bb3ffdf7b96165bb438f3441de4b02fa213aa750fb7cbf9e536e46237ea00d956d55b9e0aa73b1523f5d45b863028715c50dfc13e7", $platform="youtube", $query="nyashinski", $history="default") { 
    switch($history) {
        case "default": { $_history = "default"; break; }   // 1 credit cost
        case "extended": { $_history = "extended"; break; } // 2 credit cost
        case "archive": { $_history = "archive"; break; }   // 3 credit cost
        DEFAULT: { $_history = "default"; break; }
    }

    $ch = curl_init();
    $headers = array(
        "clientid:" . $clientid,
        "token:" . $token,
        "query:" . $query,
        "history:" . $_history
    );

    curl_setopt($ch, CURLOPT_URL, "https://matrix.sbapis.com/b/$platform/statistics");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = json_decode(curl_exec($ch), TRUE);
    
    curl_close($ch);    
    echo '<pre>'; print_r($response); echo '<pre>';
}

// Get User Statistics Lookup
//$result = curl_socialblade_api_user_stat("", "", "youtube", "socialblade", "default");


}


