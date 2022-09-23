<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Goutte\Client;
use File;
use Exception;
use Http;

class graphController extends Controller
{
    //##**_______________________________________REPORTS____________________________________##**

//@@Report YT
 public function reportYT(){
    // **Latest Monthly Views

// **Latest Monthly Views
  $artist_id='7KY9NaOVRmptl8vlpVomi6';
  $base_url='https://sandbox.api.soundcharts.com/api/v2/artist/ca22091a-3c00-11e9-974f-549f35141000/streaming/youtube/views/2020/10';

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

$views=array();$i=0;
foreach($response['items'] as $data){
$date=explode('T',$data['date']);
$views[$i]['date'] = date_format(date_create($date[0]),'d M'); 
$views[$i]['view'] = $data['value']; $i++;
}


// **Latest Monthly Subs
  $base_url='https://sandbox.api.soundcharts.com/api/v2/artist/11e81bcc-9c1c-ce38-b96b-a0369fe50396/social/youtube?endDate=2020-10-10';

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

$subs=array(); $subs_real=array(); $i=1; 
$pre_value = $response['items'][0]['value'];

foreach($response['items'] as $data){
$date=explode('T',$data['date']);
$subs[$i]['date'] = date_format(date_create($date[0]),'d M'); 
$subs[$i]['view'] = $data['value']-$pre_value; $i++;
$subs_real[$i]['view'] = $data['value'];
$pre_value=$data['value'];
}
//echo '<pre>'; print_r($subs); echo '<pre>'; return; 

    return view('streaming.report_yt', compact('views','subs','subs_real'));
 }



 ////@@Report SP
public function reportSP(){

// Monthly Listeners

  $artist_id='7KY9NaOVRmptl8vlpVomi6';
  $base_url='https://sandbox.api.soundcharts.com/api/v2/artist/11e81bcc-9c1c-ce38-b96b-a0369fe50396/streaming/spotify/listeners/2020/10';
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
   //echo '<pre>'; print_r($response); echo '<pre>'; return; 

 $listeners=$response['items'][0]['value'];
//Monthly Listeners



$views=array();$i=0;
foreach($response['items'] as $data){
$date=explode('T',$data['date']);
$views[$i]['date'] = date_format(date_create($date[0]),'d M'); 
$views[$i]['view'] = $data['value']; $i++;
}


//echo '<pre>'; print_r($subs); echo '<pre>'; return; 

    return view('streaming.report_sp', compact('views'));
 }



//@@ REPORT APPLE
 public function reportAPP(){

// Monthly Listeners

  $artist_id='7KY9NaOVRmptl8vlpVomi6';
  $base_url='https://sandbox.api.soundcharts.com/api/v2/artist/11e81bcc-9c1c-ce38-b96b-a0369fe50396/streaming/spotify/listeners/2020/10';
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
   //echo '<pre>'; print_r($response); echo '<pre>'; return; 

 $listeners=$response['items'][0]['value'];
//Monthly Listeners



$views=array();$i=0;
foreach($response['items'] as $data){
$date=explode('T',$data['date']);
$views[$i]['date'] = date_format(date_create($date[0]),'d M'); 
$views[$i]['view'] = $data['value']; $i++;
}


//echo '<pre>'; print_r($subs); echo '<pre>'; return; 

    return view('streaming.report_sp', compact('views','subs','subs_real'));
 }



 //@@ REPORT Boom
 public function reportBOOM(){
// Monthly Listeners

  $artist_id='7KY9NaOVRmptl8vlpVomi6';
  $base_url='https://sandbox.api.soundcharts.com/api/v2/artist/11e81bcc-9c1c-ce38-b96b-a0369fe50396/streaming/spotify/listeners/2020/10';
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
   //echo '<pre>'; print_r($response); echo '<pre>'; return; 

 $listeners=$response['items'][0]['value'];
//Monthly Listeners



$views=array();$i=0;
foreach($response['items'] as $data){
$date=explode('T',$data['date']);
$views[$i]['date'] = date_format(date_create($date[0]),'d M'); 
$views[$i]['view'] = $data['value']; $i++;
}



//echo '<pre>'; print_r($subs); echo '<pre>'; return; 

    return view('streaming.report_sp', compact('views','subs','subs_real'));
 }



 //@@ REPORT MDUNDO
 public function reportMDN(){
// Monthly Listeners

  $artist_id='7KY9NaOVRmptl8vlpVomi6';
  $base_url='https://sandbox.api.soundcharts.com/api/v2/artist/11e81bcc-9c1c-ce38-b96b-a0369fe50396/streaming/spotify/listeners/2020/10';
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
   //echo '<pre>'; print_r($response); echo '<pre>'; return; 

 $listeners=$response['items'][0]['value'];
//Monthly Listeners



$views=array();$i=0;
foreach($response['items'] as $data){
$date=explode('T',$data['date']);
$views[$i]['date'] = date_format(date_create($date[0]),'d M'); 
$views[$i]['view'] = $data['value']; $i++;
}



//echo '<pre>'; print_r($subs); echo '<pre>'; return; 

    return view('streaming.report_sp', compact('views','subs','subs_real'));
 }



 //@@ REPORT DEEZER
 public function reportDZZ(){
// Monthly Fans

  $artist_id='7KY9NaOVRmptl8vlpVomi6';
  $base_url='https://sandbox.api.soundcharts.com/api/v2/artist/11e81bcc-9c1c-ce38-b96b-a0369fe50396/social/deezer?endDate=2020-10-10';
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
   //echo '<pre>'; print_r($response); echo '<pre>'; return; 

 $fans=$response['items'][0]['value'];
//Monthly FANS

$subs_real=array(); $i=1; 
$pre_value = $response['items'][0]['value'];
$views=array();

foreach($response['items'] as $data){
$date=explode('T',$data['date']);
$views[$i]['date'] = date_format(date_create($date[0]),'d M'); 
$views[$i]['view'] = $data['value']-$pre_value; 
$subs_real[$i]['view'] = $data['value'];
$pre_value=$data['value'];$i++;
}



//echo '<pre>'; print_r($subs); echo '<pre>'; return; 

    return view('streaming.report_dzz', compact('views','subs_real'));
 }

//END


}
