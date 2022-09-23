<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use DB;

class lastDaySongs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shift:last_day_songs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'top 20 songs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    { 
    
    $data=array(); $data['song']=uniqid();
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
    $artists=array();


    // // 5 D A Y S
for($day=1;$day<=5;$day++) {

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

foreach($title_count as $key => $value){
if($cn>20) break;
$songs20[$key] = $value;
$cn++;
}


//DATABASE INSERT/UPDATE


//

//foreach($title_count as $k=>$val) {
//echo '<pre>';echo $cn++; echo $k.'=>'.$val; echo '<pre>';  }exit;

  $datas=array();
  $position=1;

  foreach($title_count as $k=>$val) {
  foreach($titles as $index => $arr){
  if($k == $arr['title']) {
    if(isset($arr['title']))  $datas['song'] = $arr['title'];

    //if(isset($arr['album'])) echo ' // Album = '.$arr['album'];  
      //if(isset($arr['release_date'])) echo ' // Release = '.$arr['release_date'];

      if(isset($arr['artist'])) $datas['artist'] = $arr['artist'];
      if(isset($arr['duration'])){
        if($arr['duration'] <= 10)
        $datas['duration'] =$arr['duration'].' mins';
        else  $datas['duration'] =round(($arr['duration']/60)).' mins';

      }
      $datas['position']=$position; 

      DB::table('last_day_songs')->where('position',$position)->update($datas);
      $position++; break;
  } 
}
if($position>20) break;
}

//DATABASE INSERT/UPDATE
    }
    

}
