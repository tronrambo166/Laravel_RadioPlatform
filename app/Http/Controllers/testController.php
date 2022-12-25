<?php   
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\User;
use App\Models\liveSongs;
use App\Models\mymusic;
use App\Models\albums;
use App\Models\streaming;
use Hash;
use PDF;
use Mail;

class testController extends Controller
{ 

public function home() { 
  $thisUser=User::where('email', Session::get('logged'))->first();
  return view('home',compact('thisUser'));
 }


 public function schedules() { 
  return view('mySchedules');
 }


 public function myMusic() { 

  $thisUser=User::where('email', Session::get('logged'))->first();
  $id=$thisUser->id;
  $musics=mymusic::where('artist_id',$id)->get();
  $albumMusics=albums::where('artist_id',$id)->get();
  $albums=albums::distinct()->get(['album_title','album_id','image','artist_id']);

  //echo '<pre>'; print_r($albums); echo '<pre>'; exit;
  return view('myMusic',compact('musics','albumMusics','albums'));
 }


 public function albumSongs($album_id) { 

  $thisUser=User::where('email', Session::get('logged'))->first(); 
  $id=$thisUser->id;
  $songs=albums::where('artist_id',$id)->where('album_id',$album_id)->get();
  return view('internalAlbumSongs',compact('songs'));
 }



  function breakdown () {
   //API
    $titles=array();
    $titles2=array();
    $songs20=array();
    $i=0; $day;$cn=0;
    $resp2=array();
    $resp3=array();
    $todays=array();
    $today=array();
    $todaySongs=array();


    // // 5 D A Y S
for($day=0;$day<=4;$day++) {

$m = date("m"); // Month value
$de = date("d"); // Today's date
$y = date("Y"); // Year value
$back5days = date('Ymd', mktime(0,0,0,$m,($de-$day),$y)) ;
$url = "https://api-v2.acrcloud.com/api/bm-bd-projects/2010/channels/246131/results?type=day&date=$back5days";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Accept: application/json",
   "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI3IiwianRpIjoiMjFiY2RmOTJiZTdjMTU3ZjhhYjRiMWUyZGM1MjBiMTQ4NWMzOTRkNjgyZDJhZTA3MWQyZDgwMTJkNjg0M2M5MjU5MmFmOGQ2MDNmNGI3ZTkiLCJpYXQiOjE2NDY1MDI2NDYuMjM3NjMzLCJuYmYiOjE2NDY1MDI2NDYuMjM3NjM2LCJleHAiOjE5NjIxMjE4NDYuMjAwMTg5LCJzdWIiOiIxMzM1OTkiLCJzY29wZXMiOlsiYm0tcHJvamVjdHMiLCJibS1jcy1wcm9qZWN0cyIsIndyaXRlLWJtLWNzLXByb2plY3RzIiwicmVhZC1ibS1jcy1wcm9qZWN0cyIsImJtLWJkLXByb2plY3RzIiwid3JpdGUtYm0tYmQtcHJvamVjdHMiLCJyZWFkLWJtLWJkLXByb2plY3RzIl19.oNEDD_T_ntzILMZdD_vxinFMGDtMne436wKEDbU887yhJaJaUJmvQH6E5KceV6w7ulCf2oZNvTZw84twUjDyr7UNwqxTvPSx2lJ8b9LF_CnDN24LshKJzmNhK5pzPLdtIdVT9494VSZXX8unIzunlHwAtiprcNzaqBW77r-BSmElFuIwRJRViYlqsuQORQiyAR9W5Wt88XPZfg9uAzcA2q0d1zAaVG6UMyY3UrSlZ62GgpPdweQkqlKvSvItORoaQ-0wTa63PBjd81J4q8UaHVAwP3_Ad_6hDkKSqj36ic79cqSW4qA1_DGOoVfKImLjH9pALqvgtquo-yw85rGa28Qlw0BQZBkDXAlvvVSOKb-MhU-Cd-MU4ACRLNWKNZYFuHH76sMn48ROkzp2Bi6NVbJQGXdayuojIc_gp-niBXvjDjcfvz-ESsC3-UO-kAHtVTx13O0fL7fKgAQqN4cWHY5jTv-MR_FC4qrOOv4d7yjfEikVmGhny7NKAnCV_PfXeP7sVMkDhiKY5hEKCkwAAkocKl0cnkyPOkBSwG3Y8ziW_tCezymwOf8RieIGtV2DhXJI2-3W56P7pbwrGBzbHIydzwVvz366N-BR26k-4pMOpiU5f7oka_dBXtnLzYSKDsEp2NifXgrW2f-Ef5tpgDyN96iG6lzvzjXPEtGDKuY",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
$resp=json_decode($resp,true);

$resp2=$resp['data'];
curl_close($curl);
//echo '<pre>'; print_r($resp2); echo '<pre>'; 

foreach($resp2 as $songs){ 
if(isset($songs['metadata']['timestamp_utc']))  //echo '<br>'. 
  $titles[$i]['timestamp']=date('m/d/Y, h:i a',strtotime($songs['metadata']['record_timestamp']));

if(isset($songs['metadata']['music'][0]['title'])) $titles[$i]['title']=$songs['metadata']['music'][0]['title'];
if(isset($songs['metadata']['music'][0]['album']['name'])) $titles[$i]['album']=$songs['metadata']['music'][0]['album']['name'];
if(isset($songs['metadata']['music'][0]['artists'][0]['name'])) $titles[$i]['artist']=$songs['metadata']['music'][0]['artists'][0]['name'];
if(isset($songs['metadata']['music'][0]['release_date'])) $titles[$i]['release_date']=$songs['metadata']['music'][0]['release_date'];
  if(isset($songs['metadata']['played_duration'])) $titles[$i]['duration']=$songs['metadata']['played_duration']; 
  $i++;
}

}

//exit;

//5 DAYS

    //return view ('success',compact('titles')); 
    $pdf = PDF::loadView('success',compact('titles')); 
    return $pdf->download('breakdown.pdf');
     }




	public function getSongs() {
    //API
    $titles=array();
    $titles2=array();
    $songs20=array();
    $i=0; $day;$cn=0;$cc=1;
    $resp2=array();
    $resp3=array();
    $todays=array();
    $today=array();
    $todaySongs=array();
    $artists=array();


    // // 5 D A Y S
for($day=0;$day<=4;$day++) {

$m = date("m"); // Month value
$de = date("d"); // Today's date
$y = date("Y"); // Year value
$back5days = date('Ymd', mktime(0,0,0,$m,($de-$day),$y)) ;
$url = "https://api-v2.acrcloud.com/api/bm-bd-projects/2010/channels/246131/results?type=day&date=$back5days";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Accept: application/json",
   "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI3IiwianRpIjoiMjFiY2RmOTJiZTdjMTU3ZjhhYjRiMWUyZGM1MjBiMTQ4NWMzOTRkNjgyZDJhZTA3MWQyZDgwMTJkNjg0M2M5MjU5MmFmOGQ2MDNmNGI3ZTkiLCJpYXQiOjE2NDY1MDI2NDYuMjM3NjMzLCJuYmYiOjE2NDY1MDI2NDYuMjM3NjM2LCJleHAiOjE5NjIxMjE4NDYuMjAwMTg5LCJzdWIiOiIxMzM1OTkiLCJzY29wZXMiOlsiYm0tcHJvamVjdHMiLCJibS1jcy1wcm9qZWN0cyIsIndyaXRlLWJtLWNzLXByb2plY3RzIiwicmVhZC1ibS1jcy1wcm9qZWN0cyIsImJtLWJkLXByb2plY3RzIiwid3JpdGUtYm0tYmQtcHJvamVjdHMiLCJyZWFkLWJtLWJkLXByb2plY3RzIl19.oNEDD_T_ntzILMZdD_vxinFMGDtMne436wKEDbU887yhJaJaUJmvQH6E5KceV6w7ulCf2oZNvTZw84twUjDyr7UNwqxTvPSx2lJ8b9LF_CnDN24LshKJzmNhK5pzPLdtIdVT9494VSZXX8unIzunlHwAtiprcNzaqBW77r-BSmElFuIwRJRViYlqsuQORQiyAR9W5Wt88XPZfg9uAzcA2q0d1zAaVG6UMyY3UrSlZ62GgpPdweQkqlKvSvItORoaQ-0wTa63PBjd81J4q8UaHVAwP3_Ad_6hDkKSqj36ic79cqSW4qA1_DGOoVfKImLjH9pALqvgtquo-yw85rGa28Qlw0BQZBkDXAlvvVSOKb-MhU-Cd-MU4ACRLNWKNZYFuHH76sMn48ROkzp2Bi6NVbJQGXdayuojIc_gp-niBXvjDjcfvz-ESsC3-UO-kAHtVTx13O0fL7fKgAQqN4cWHY5jTv-MR_FC4qrOOv4d7yjfEikVmGhny7NKAnCV_PfXeP7sVMkDhiKY5hEKCkwAAkocKl0cnkyPOkBSwG3Y8ziW_tCezymwOf8RieIGtV2DhXJI2-3W56P7pbwrGBzbHIydzwVvz366N-BR26k-4pMOpiU5f7oka_dBXtnLzYSKDsEp2NifXgrW2f-Ef5tpgDyN96iG6lzvzjXPEtGDKuY",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
$resp=json_decode($resp,true);

$resp2=$resp['data'];
curl_close($curl);
//echo '<pre>'; print_r($resp2); echo '<pre>'; 

foreach($resp2 as $songs){  
$titles2[$i]=$songs['metadata']['music'][0]['title']; $artists[$i]=$songs['metadata']['music'][0]['artists'][0]['name'];

if(isset($songs['metadata']['music'][0]['title'])) $titles[$i]['title']=$songs['metadata']['music'][0]['title'];
if(isset($songs['metadata']['music'][0]['album']['name'])) $titles[$i]['album']=$songs['metadata']['music'][0]['album']['name'];
if(isset($songs['metadata']['music'][0]['artists'][0]['name'])) $titles[$i]['artist']=$songs['metadata']['music'][0]['artists'][0]['name'];
if(isset($songs['metadata']['music'][0]['release_date'])) $titles[$i]['release_date']=$songs['metadata']['music'][0]['release_date'];
  if(isset($songs['metadata']['played_duration'])) $titles[$i]['duration']=$songs['metadata']['played_duration']; 
  $i++;
}

}

$title_count_all=array_count_values($titles2); arsort($title_count_all);

$title_count=array_count_values($titles2); arsort($title_count);
$artist_count=array_count_values($artists); arsort($artist_count);

/*
foreach($title_count as $key => $value){
if($cn>20) break;
$songs20[$key] = $value;
$cn++;
}
*/

$static20=liveSongs::get();
 foreach($static20 as $s){
if($cn>20) break;
$cc=1;

//New code

 foreach($title_count as $key => $value) {
 if( $s->song == $key){
 
if($cc>20) $pos='up';
else if($s->id==$cc)  $pos='not';
else if($s->id<$cc) $pos='down';
else $pos='up';

//New code
$songs20[$key] = $pos;
$cc++;
break;
}   

}

 $cn++; 

} 






$a=0;
// Today

$currentdate = date('Ymd');
$url = "https://api-v2.acrcloud.com/api/bm-bd-projects/2010/channels/246131/results?type=day&date=$currentdate";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Accept: application/json",
   "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI3IiwianRpIjoiMjFiY2RmOTJiZTdjMTU3ZjhhYjRiMWUyZGM1MjBiMTQ4NWMzOTRkNjgyZDJhZTA3MWQyZDgwMTJkNjg0M2M5MjU5MmFmOGQ2MDNmNGI3ZTkiLCJpYXQiOjE2NDY1MDI2NDYuMjM3NjMzLCJuYmYiOjE2NDY1MDI2NDYuMjM3NjM2LCJleHAiOjE5NjIxMjE4NDYuMjAwMTg5LCJzdWIiOiIxMzM1OTkiLCJzY29wZXMiOlsiYm0tcHJvamVjdHMiLCJibS1jcy1wcm9qZWN0cyIsIndyaXRlLWJtLWNzLXByb2plY3RzIiwicmVhZC1ibS1jcy1wcm9qZWN0cyIsImJtLWJkLXByb2plY3RzIiwid3JpdGUtYm0tYmQtcHJvamVjdHMiLCJyZWFkLWJtLWJkLXByb2plY3RzIl19.oNEDD_T_ntzILMZdD_vxinFMGDtMne436wKEDbU887yhJaJaUJmvQH6E5KceV6w7ulCf2oZNvTZw84twUjDyr7UNwqxTvPSx2lJ8b9LF_CnDN24LshKJzmNhK5pzPLdtIdVT9494VSZXX8unIzunlHwAtiprcNzaqBW77r-BSmElFuIwRJRViYlqsuQORQiyAR9W5Wt88XPZfg9uAzcA2q0d1zAaVG6UMyY3UrSlZ62GgpPdweQkqlKvSvItORoaQ-0wTa63PBjd81J4q8UaHVAwP3_Ad_6hDkKSqj36ic79cqSW4qA1_DGOoVfKImLjH9pALqvgtquo-yw85rGa28Qlw0BQZBkDXAlvvVSOKb-MhU-Cd-MU4ACRLNWKNZYFuHH76sMn48ROkzp2Bi6NVbJQGXdayuojIc_gp-niBXvjDjcfvz-ESsC3-UO-kAHtVTx13O0fL7fKgAQqN4cWHY5jTv-MR_FC4qrOOv4d7yjfEikVmGhny7NKAnCV_PfXeP7sVMkDhiKY5hEKCkwAAkocKl0cnkyPOkBSwG3Y8ziW_tCezymwOf8RieIGtV2DhXJI2-3W56P7pbwrGBzbHIydzwVvz366N-BR26k-4pMOpiU5f7oka_dBXtnLzYSKDsEp2NifXgrW2f-Ef5tpgDyN96iG6lzvzjXPEtGDKuY",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
$resp=json_decode($resp,true);
$resp=$resp['data'];
curl_close($curl);
//echo '<pre>'; print_r($resp); echo '<pre>'; 

foreach($resp as $songs){ 
  $todays[$a]=$songs['metadata']['music'][0]['artists'][0]['name']; $a++;
}

$today=array_count_values($todays); arsort($today);
//foreach($today as $k=>$val) 
//$todaySongs[$k]=$val;


// Today



//return view('home', compact('songs20', 'titles'));
  return response()->json(['data'=>$songs20, 'data2'=>$titles, 'today'=> $today, 
    'artists'=>$artist_count,'all_titles'=>$title_count_all]);
// // 5 D A Y S



    
        //API

    //return view('home');
}


  public function radio() {


    // Recent
$i=0;$j=0;
$titles=array();
$currentdate = date('Ymd');
$url = "https://api-v2.acrcloud.com/api/bm-bd-projects/2010/channels/246131/results?type=last";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Accept: application/json",
   "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI3IiwianRpIjoiMjFiY2RmOTJiZTdjMTU3ZjhhYjRiMWUyZGM1MjBiMTQ4NWMzOTRkNjgyZDJhZTA3MWQyZDgwMTJkNjg0M2M5MjU5MmFmOGQ2MDNmNGI3ZTkiLCJpYXQiOjE2NDY1MDI2NDYuMjM3NjMzLCJuYmYiOjE2NDY1MDI2NDYuMjM3NjM2LCJleHAiOjE5NjIxMjE4NDYuMjAwMTg5LCJzdWIiOiIxMzM1OTkiLCJzY29wZXMiOlsiYm0tcHJvamVjdHMiLCJibS1jcy1wcm9qZWN0cyIsIndyaXRlLWJtLWNzLXByb2plY3RzIiwicmVhZC1ibS1jcy1wcm9qZWN0cyIsImJtLWJkLXByb2plY3RzIiwid3JpdGUtYm0tYmQtcHJvamVjdHMiLCJyZWFkLWJtLWJkLXByb2plY3RzIl19.oNEDD_T_ntzILMZdD_vxinFMGDtMne436wKEDbU887yhJaJaUJmvQH6E5KceV6w7ulCf2oZNvTZw84twUjDyr7UNwqxTvPSx2lJ8b9LF_CnDN24LshKJzmNhK5pzPLdtIdVT9494VSZXX8unIzunlHwAtiprcNzaqBW77r-BSmElFuIwRJRViYlqsuQORQiyAR9W5Wt88XPZfg9uAzcA2q0d1zAaVG6UMyY3UrSlZ62GgpPdweQkqlKvSvItORoaQ-0wTa63PBjd81J4q8UaHVAwP3_Ad_6hDkKSqj36ic79cqSW4qA1_DGOoVfKImLjH9pALqvgtquo-yw85rGa28Qlw0BQZBkDXAlvvVSOKb-MhU-Cd-MU4ACRLNWKNZYFuHH76sMn48ROkzp2Bi6NVbJQGXdayuojIc_gp-niBXvjDjcfvz-ESsC3-UO-kAHtVTx13O0fL7fKgAQqN4cWHY5jTv-MR_FC4qrOOv4d7yjfEikVmGhny7NKAnCV_PfXeP7sVMkDhiKY5hEKCkwAAkocKl0cnkyPOkBSwG3Y8ziW_tCezymwOf8RieIGtV2DhXJI2-3W56P7pbwrGBzbHIydzwVvz366N-BR26k-4pMOpiU5f7oka_dBXtnLzYSKDsEp2NifXgrW2f-Ef5tpgDyN96iG6lzvzjXPEtGDKuY",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
$resp=json_decode($resp,true);
$resp=$resp['data'];
curl_close($curl);
//echo '<pre>'; print_r($resp); echo '<pre>'; exit; 

  foreach($resp as $songs){  
if(isset($songs['metadata']['music'][0]['title'])) $titles['title']=$songs['metadata']['music'][0]['title'];

if(isset($songs['metadata']['music'][0]['artists'][0]['name'])) $titles['artist']=$songs['metadata']['music'][0]['artists'][0]['name'];

  if(isset($songs['metadata']['played_duration'])) $titles['duration']=$songs['metadata']['played_duration']; 
  //$i++;
} 
// Recent

    return view('radio',compact('titles'));
}


  public function bio() {
    $thisUser=User::where('email', Session::get('logged'))->first();
    return view('bio',compact('thisUser'));
}

public function streaming() { 
   $art=User::where('email', Session::get('logged'))->first();$art_id=$art->id;
   $stream = streaming::where('user_id',$art_id)->first();
   if($stream->apple_id == null || $stream->deezer_id == null || $stream->youtube_id == null || $stream->spotify_id == null || $stream->boomplay_id == null || $stream->mdundo_id == null)
     $complete = 0;
     else $complete = 1;
     return view('streaming',compact('complete'));
 }

 public function realSocial() { 
  return view('realSocial');
 }

 public function payout() { 
  return view('payout');
 }



  public function about() {
    return view('about');
}

 public function login() {
    //return view('login');
  $static20=liveSongs::get();
  return view('UserPages.static20',compact('static20'));
}


public function logout() {
   Session::forget('logged');
   Session::forget('Userlogged');
   if(Session::has('contact_id'))
   Session::forget('contact_id');

   return redirect('/');
}


 public function register() {
    return view('register');
}

public function updateBio(Request $hos)
    {    $thisUser=User::where('email', Session::get('logged'))->first();
         $id=$thisUser->id;
          User::where('id',$id)->update($hos->except(['_token']));

          //SINGLE IMG
          if($hos->image!=''){
          $image=$hos->file('image');
          $uniqid=hexdec(uniqid());
          $ext=strtolower($image->getClientOriginalExtension());
          $create_name=$uniqid.'.'.$ext; 
          $loc='images/artists';
          $image->move($loc, $create_name);

          $datas['image']=$create_name;
          DB::table('users')->where('id',$id)->update($datas);
       
 }
         //SINGLE IMG

          return redirect()->back(); 
      }



 public function register_post(Request $hos)
    {    

//Private Sign up
  if(isset($hos->art_id)){
  $art_id=$hos->art_id;
  $email= $hos->email;
  $art= User::where('art_id', $art_id)->where('email', $email)->get();
         
     if($art->count() >0 ) {
    //SINGLE IMG
          if($hos->image!=''){
          $image=$hos->file('image');
          $uniqid=hexdec(uniqid());
          $ext=strtolower($image->getClientOriginalExtension());
          $create_name=$uniqid.'.'.$ext; 
          $loc='images/artists';
          $image->move($loc, $create_name);
          $image=$create_name;
         // DB::table('users')->where('id',$id)->update($datas);       
   }
   //SINGLE IMG

          $data=array();         
          $data['bio'] =       $hos->bio; 
          $data['password'] =  Hash::make($hos->password);
          $data['country'] =   $hos->country;
          $data['city'] =      $hos->city;
          $data['image'] =     $image;
          $data['phone'] =     $hos->phone;
          $data['approved'] = 1;

         DB::table('users')->where('art_id',$art_id)->update($data);
           Session::put('logged',$email);
           return redirect('home');
         }
        

           else 
            {
               Session::put('login_err',"Invalid Artist Id! Please reach out to help@muziqyrewind.com."); 
               return redirect('/'); 
             }

    }

    //Private Sign up

           $fname=$hos->fname;
           $lname=$hos->fname;
           $stage_name=$hos->stage_name;
           $art_id=$fname.uniqid();//$hos->art_id;
           $email=$hos->email;
           $phone=$hos->phone;
           //$password=$hos->password;
           //$c_password=$hos->c_password;
           //$bio=$hos->bio;
          // $country=$hos->country;
          // $city=$hos->city;
          
         // if($password!=$c_password){
         // Session::put('email',"Password don't match!"); return  redirect('/');  }
         // $password=Hash::make($hos->password); 

        $user= User::where('email', $email)->get(); 
        $art= User::where('art_id', $art_id)->get();
        $stage= User::where('stage_name', $stage_name)->get();
              
          if($user->count() >0 ) {
         
          Session::put('email','Email already exists'); return  redirect('/');
          }
          
           else if($art->count() >0 ) {
         
          Session::put('email','Id already exists'); return  redirect('/');
          }
          
           else if($stage->count() >0 ) {
         
          Session::put('email','Stage Name already exists'); return  redirect('/');
          }
      
      else{


          $Artist = User::create([
          'fname' =>  $fname,
           'lname' =>  $lname,
            'stage_name' =>  $stage_name,
             'art_id' =>  $art_id,
             'email' =>  $email,
         // 'bio' =>  $bio,
          //'password' =>  $password,
          //'country' =>  $country,
         // 'city' =>  $city,
          //'image' => $image,
          'phone' => $phone,
          'approved' => 0
          ]);
          Session::put('logged',$email);
      
          
          /* Send Email
        $info=['Name'=>'Dele', 'email' => $email];
        $user['to']= $email;
        Mail::send('welcome_mail', $info, function($msg) use ($user){
            $msg->to($user['to']);
            $msg->subject('Welcome Mail');

        });
        // Send Email */


         Session::put('login_err',"Thank you, Rewind has received your sign up request and will reach out for next steps, your account is yet to be approved!"); return redirect('/');
     }

    }



public function registerB(Request $hos)
    {    
    
          if($hos->image!=''){
          $image=$hos->file('image');
          $uniqid=hexdec(uniqid());
          $ext=strtolower($image->getClientOriginalExtension());
          $create_name=$uniqid.'.'.$ext; 
          $loc='images/artists';
          $image->move($loc, $create_name);
          $image=$create_name;      
   }      else $image = 'user.png';
   //SINGLE IMG
           $stage_name=$hos->stage_name;
           $email=$hos->email;
           $password=Hash::make($hos->password);
           $phone=$hos->phone;
           
        $user= User::where('email', $email)->get(); 
        $stage= User::where('stage_name', $stage_name)->get();
              
          if($user->count() >0 ) {
         
          Session::put('email','Email already exists'); return  redirect('/');
          }
          
           else if($stage->count() >0 ) {
         
          Session::put('email','Business Name already exists'); return  redirect('/');
          }
      
      else{

          $Artist = User::create([
          'stage_name' =>  $stage_name,
          'email' =>  $email,
          'password' =>  $password,
          'image' => $image,
          'phone' => $phone,
          'approved' => 1,
          'business' => 1
          ]);
          Session::put('logged',$email);
          return redirect('home');
     }

    }



public function login_post(Request $formData)
{  

$email = $formData->email;
$password = $formData->password;
$user= User::where('email', $email)->first(); 
//$check_user=json_decode($user,true);

if($user==null)
{ Session::put('login_err',"User don't exist!"); return redirect('/');  }

if($user->count() >0 ) { //return $user->art_id;

  if($user->approved==0)
{ Session::put('login_err',"Thank you, Rewind has received your sign up request and will reach out for next steps, your account is yet to be approved!"); return redirect('/');  }


$db_password=$user->password; //opd_admin
if(password_verify($password, $db_password)) {
    Session::put('logged',$email);
    return redirect('home');
  }


else
     Session::put('login_err','Password wrong!'); return  redirect('/');
}

  else { Session::put('login_err','user dont exist!'); return  redirect('/');  }
 
 }
 
 
 public function forgot($remail)
    { 

         return view('forgot_password',compact('remail'));
     
    }




public function send_reset_email(Request $request)
    {

        $remail=$request->email;
        $user= User::where('email', $remail)->first(); 
        if($user==null)
        { Session::put('login_err',"User with this email don't exist!"); return redirect()->back(); }
        

        // Send Email

        $info=['Name'=>'KANE', 'email' => $remail];
        $user['to']= $remail;
        Mail::send('mails.approve_mail', $info, function($msg) use ($user){

            $msg->to($user['to']);
            $msg->subject('Password Reset');

        });

        echo "We sent you a reset link, Check your email!"; exit;

        // Send Email

    }



    public function send_artist_approve_email(Request $request)
    {

        $remail=$request->email;
        $user= User::where('email', $remail)->first(); 
        if($user==null)
        { Session::put('login_err',"User with this email don't exist!"); return redirect()->back(); }
        

        // Send Email

        $info=['Name'=>'KANE', 'email' => $remail, 'art_id' => $user->art_id];
        $user['to']= $remail;
        Mail::send('mails.approve_mail', $info, function($msg) use ($user){

            $msg->to($user['to']);
            $msg->subject('Password Reset');

        });

        echo "Approved!"; exit;

        // Send Email

    }



public function reset(Request $request, $remail)
    {

       $email=$remail;
        $password_1=$request->password; 
       $password=$request->c_password; 

       if($password_1==$password) {
     $password_1= Hash::make($password_1);
     $update= DB::table('users')->where('email', $email)
     -> limit(1)->update(['password'=> $password_1]);

     if($update) {Session::put('reset', 'password reset success!');return redirect('login'); }
       }    
          else {
            Session::put('wrong_pwd', 'password do not match! try again');
          return redirect()->back();
      }

    }

//MP3 My Music
    public function singleMp3Upload(Request $request)
    {
        $thisUser=User::where('email', Session::get('logged'))->first();
        $id=$thisUser->id;

       // validation
       $validatedData = $request->validate([
            'song' =>'required|mimes:audio/mpeg,mp3',
        ]); 

         $title=$request->title;   

       //SINGLE Song
          $song=$request->file('song');
          $uniqid=hexdec(uniqid());
          $ext=strtolower($song->getClientOriginalExtension());
          $create_name=$title.'.'.$ext; 
          $loc='mp3Music';
          $song->move($loc, $create_name);
          $songTitle=$create_name;  
          
       //SINGLE Song

      //SINGLE Cover
          $cover=$request->file('song_art');
          $uniqid=hexdec(uniqid());
          $ext=strtolower($cover->getClientOriginalExtension());
          $create_cover_name=$title.'.'.$ext; 
          $loc='images/singles';
          $cover->move($loc, $create_cover_name);
          $datas['song_art']=$create_cover_name;  
          
       //SINGLE Cover

      mymusic::insert($request->except(['_token']));
    
      $last_song= DB::table('mymusics')->latest('id')->first();
      DB::table('mymusics')->where('id',$last_song->id)->update($datas);

       Session::put('song','Song added successfully!');
       return redirect()->back();
      //DB::table('mymusics')->where('id',$id)->update($datas);

    }


     public function albumUpload(Request $request)
    {

       $thisUser=User::where('email', Session::get('logged'))->first();
       $id=$thisUser->id;

       // validation
       $validatedData = $request->validate([
            //'song' =>'required|mimes:audio/mpeg,mp3',
        ]); 
          $data=array();

           $song=$request->file('song'); 
           $data['album_title']=$request->album_title;  
           $data['album_description']=$request->album_description;  
           $data['composer']=$request->composer;
           $data['publisher']=$request->publisher;
           //$data['song_art']=$request->song_art;  
           $data['artist_id']=$id; 
           $data['album_id']=uniqid(); 

        //SINGLE IMG
          if($request->image!=''){
          $image=$request->file('image');
          $uniqid=hexdec(uniqid());
          $ext=strtolower($image->getClientOriginalExtension());
          $create_name=$uniqid.'.'.$ext; 
          $loc='images/albums';
          $image->move($loc, $create_name);
          $data['image']=$create_name; 
        }
        else $data['image']='default.png'; 
        //SINGLE IMG

       //Multi Song
          foreach ($song as $single_song) {  
          $uniqid=hexdec(uniqid());
          $ext=strtolower($single_song->getClientOriginalExtension());
          $name=strtolower($single_song->getClientOriginalName());
          $create_name=$name; 
          $loc='albums';
          $single_song->move($loc, $create_name);
          $data['title']=$create_name; 

          DB::table('albums')->insert($data);
          
                 }     
       //Multi Song
          Session::put('song','Album added successfully!');
          return redirect()->back();

    }





}
