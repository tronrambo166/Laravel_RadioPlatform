<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Goutte\Client;
use Embed\Embed;
use File;
use Exception;
use Http;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use InstagramScraper\Instagram;
use Phpfastcache\Helper\Psr16Adapter;
use Atymic\Twitter\Twitter as TwitterContract;
use Illuminate\Http\JsonResponse;
use Twitter;

class socialController extends Controller
{
    public $i=0, $j=0, $cnt2=0, $cnt=1, $k=0;

//FACEBOOK
public function facebook() 
    { 
         $data = array();
         $user = Socialite::driver('facebook')->user(); 
         $userToken = $user->token;
         $userId = $user->id; //return $userToken.'`````'.$userId;

         
         /*/ !!! Public page test !!!
          $curl=curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL=> 'https://graph.facebook.com/101772626079890?access_token='.$userToken,
        CURLOPT_RETURNTRANSFER=> TRUE,
        CURLOPT_ENCODING=> '',
        CURLOPT_MAXREDIRS=> 10,
        CURLOPT_TIMEOUT=> 30,
        CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST=> 'GET',
        CURLOPT_HTTPHEADER=> array(
        'content-type:application/json'    
        ),
        ));

        $response=curl_exec($curl); dd($response);
        $response=json_decode($response,true);
        echo '<pre>';print_r($response);echo '<pre>'; exit;
        //$pageToken = $response['data'][0]['access_token'];
        //$pageId = $response['data'][0]['id']; //111090717339468  101772626079890

        $error=curl_error($curl);
        if($error) echo $error;  */


        //!!! Page ID & Token !!!

        $curl=curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL=> 'https://graph.facebook.com/'.$userId.'/accounts?access_token='.$userToken,
        CURLOPT_RETURNTRANSFER=> TRUE,
        CURLOPT_ENCODING=> '',
        CURLOPT_MAXREDIRS=> 10,
        CURLOPT_TIMEOUT=> 30,
        CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST=> 'GET',
        CURLOPT_HTTPHEADER=> array(
        'content-type:application/json'    
        ),
        ));

        $response=curl_exec($curl); //dd($response);
        $response=json_decode($response,true);
        //echo '<pre>';print_r($response);echo '<pre>';
        $pageToken = $response['data'][0]['access_token'];
        $pageId = $response['data'][0]['id']; //111090717339468

        $error=curl_error($curl);
        if($error) echo $error; 


        //Part 1.1: !!! Page Insights Likes !!!
        $curl=curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL=> 'https://graph.facebook.com/'.$pageId.'/insights/page_fan_adds_unique?access_token='.$pageToken,
        CURLOPT_RETURNTRANSFER=> TRUE,
        CURLOPT_ENCODING=> '',
        CURLOPT_MAXREDIRS=> 10,
        CURLOPT_TIMEOUT=> 30,
        CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST=> 'GET',
        CURLOPT_HTTPHEADER=> array(
        'content-type:application/json'    
        ),
        ));

        $response=curl_exec($curl); //dd($response);
        $response=json_decode($response,true);
        $data['daily_new_likes'] = $response['data'][0]['values'][1]['value'];
        $data['weekly_new_likes'] = $response['data'][1]['values'][1]['value']; 
        $data['monthly_new_likes'] = $response['data'][2]['values'][1]['value'];
        //echo '<pre>';print_r($response);echo '<pre>'; 



        //Part 1.2: !!! Page Insights Talking Abouts !!!
        $curl=curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL=> 'https://graph.facebook.com/'.$pageId.'/insights/page_content_activity_by_action_type_unique?access_token='.$pageToken,
        CURLOPT_RETURNTRANSFER=> TRUE,
        CURLOPT_ENCODING=> '',
        CURLOPT_MAXREDIRS=> 10,
        CURLOPT_TIMEOUT=> 30,
        CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST=> 'GET',
        CURLOPT_HTTPHEADER=> array(
        'content-type:application/json'    
        ),
        ));

        $response=curl_exec($curl); //dd($response);
        $response=json_decode($response,true); 
        if($response['data'][0]['values'][1]['value']){
        $data['daily_new_taking'] = $response['data'][0]['values'][1]['value'];
        $data['weekly_new_taking'] = $response['data'][1]['values'][1]['value']; 
        $data['monthly_new_taking'] = $response['data'][2]['values'][1]['value'];
        } else{
        $data['daily_new_taking'] = 0;
        $data['weekly_new_taking'] = 0;
        $data['monthly_new_taking'] = 0;
        }
        //echo '<pre> taking = ';print_r($response);echo '<pre>'; 



        //Part 2.1: !!! Audience Gender/Age !!!
        $curl=curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL=> 'https://graph.facebook.com/'.$pageId.'/insights/page_fans_gender_age?access_token='.$pageToken,
        CURLOPT_RETURNTRANSFER=> TRUE,
        CURLOPT_ENCODING=> '',
        CURLOPT_MAXREDIRS=> 10,
        CURLOPT_TIMEOUT=> 30,
        CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST=> 'GET',
        CURLOPT_HTTPHEADER=> array(
        'content-type:application/json'    
        ),
        ));

        $response=curl_exec($curl); //dd($response);
        $response=json_decode($response,true);
        if($response['data'][0]['values'][1]['value']){
        $data['fans_by_gender'] = $response['data'][0]['values'][1]['value'];
       // $data['weekly_new_taking'] = $response['data'][1]['values'][1]['value']; 
       // $data['monthly_new_taking'] = $response['data'][2]['values'][1]['value'];
        }
        //echo '<pre> Audience = ';print_r($response);echo '<pre>'; exit;


        //Part 2.2: !!! Audience by City/Country !!!
        $curl=curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL=> 'https://graph.facebook.com/'.$pageId.'/insights/page_fans_city?access_token='.$pageToken,
        CURLOPT_RETURNTRANSFER=> TRUE,
        CURLOPT_ENCODING=> '',
        CURLOPT_MAXREDIRS=> 10,
        CURLOPT_TIMEOUT=> 30,
        CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST=> 'GET',
        CURLOPT_HTTPHEADER=> array(
        'content-type:application/json'    
        ),
        ));

        $response=curl_exec($curl); //dd($response);
        $response=json_decode($response,true);
        $data['fans_by_city'] = $response['data'][0]['values'][1]['value'];
        //$data['fans_by_cityW'] = $response['data'][1]['values'][1]['value']; 
        //$data['fans_by_cityM'] = $response['data'][2]['values'][1]['value'];
        //echo '<pre> taking = ';print_r($response);echo '<pre>'; exit;



  //!!! Part 3.1 Page Insights Impressions/Reach by gender/age !!!

         $curl=curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL=> 'https://graph.facebook.com/'.$pageId.'/insights/page_impressions_by_age_gender_unique?access_token='.$pageToken,
        CURLOPT_RETURNTRANSFER=> TRUE,
        CURLOPT_ENCODING=> '',
        CURLOPT_MAXREDIRS=> 10,
        CURLOPT_TIMEOUT=> 30,
        CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST=> 'GET',
        CURLOPT_HTTPHEADER=> array(
        'content-type:application/json'    
        ),
        ));

        $response=curl_exec($curl); //dd($response);
        $response=json_decode($response,true);
        if(isset($response['data'][0]['values'][1]['value'])){
        $data['daily_new_impress'] = $response['data'][0]['values'][1]['value'];
        $data['weekly_new_impress'] = $response['data'][1]['values'][1]['value']; 
        $data['monthly_new_impress'] = $response['data'][2]['values'][1]['value'];
        }
        //echo '<pre> Impress = ';print_r($response);echo '<pre>'; exit;



  //!!! Part 3.2 Page Insights Engagements Total !!!
        $curl=curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL=> 'https://graph.facebook.com/'.$pageId.'/insights/page_impressions_unique?access_token='.$pageToken,
        CURLOPT_RETURNTRANSFER=> TRUE,
        CURLOPT_ENCODING=> '',
        CURLOPT_MAXREDIRS=> 10,
        CURLOPT_TIMEOUT=> 30,
        CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST=> 'GET',
        CURLOPT_HTTPHEADER=> array(
        'content-type:application/json'    
        ),
        ));

        $response=curl_exec($curl); //dd($response);
        $response=json_decode($response,true);
        $data['daily_total_reach'] = $response['data'][0]['values'][1]['value'];
        $data['weekly_total_reach'] = $response['data'][1]['values'][1]['value']; 
        $data['monthly_total_reach'] = $response['data'][2]['values'][1]['value'];
        //echo '<pre>';print_r($response);echo '<pre>'; exit;
        //return view('social.facebook',compact('data'));

        $male = array(); $female = array();
        $result = $data['fans_by_gender'];
        foreach($result as $key => $value){
            $key = explode('.',$key);
            if($key[0] == 'M') $male[$key[1]] = $value;
            else               $female[$key[1]] = $value;
        } 
        Session::put('male',$male); Session::put('female',$female);
        Session::put('daily_new_taking',$data['daily_new_taking']);
        Session::put('weekly_new_taking',$data['weekly_new_taking']);
        Session::put('monthly_new_taking',$data['monthly_new_taking']);
        return redirect()->route('social_facebook');


   
    }
    public function gotoFacebook()
    {
        return view('social.facebook');
    }


    public function twitter()
    {
    $data = array(); //user-id = 1587075783545217025
    $querier = \Atymic\Twitter\Facade\Twitter::forApiV2()
    ->getQuerier();

     $result = $querier
    ->withOAuth2Client()
    ->get('tweets/counts/recent', ['query' => 'foo']);
     echo '<pre>'; print_r($result); echo '<pre>'; exit;

    $result = $querier
    ->withOAuth2Client()
    ->get('users/1587075783545217025/followers');
	 $data['followers'] = $result->meta->result_count;

    }


    public function tiktok()
    {
        $client = new Client();

        $url = 'https://www.tiktok.com/@real.shinski';
        $data= $client->request('GET', $url);
        $region=$data->filter('#') //->text(); return $region;
        ->each(function($item){      
         $this->j++; echo ' // '.$item->text();
         $this->cnt++;        
        });
    }



     public function instagram()
    {
        $instagram = \InstagramScraper\Instagram::withCredentials(new \GuzzleHttp\Client(), 'nurulrana6', 'rana0000', new Psr16Adapter('Files')); 
        $instagram->login(); // will use cached session if you want to force login $instagram->login(true)
        //$instagram->saveSession();  //DO NOT forget this in order to save the session, otherwise have no sense
        $account = $instagram->getAccount('nurulrana6'); dd($account);
        $accountMedias = $account->getMedias(); 
        foreach ($accountMedias as $key  => $accountMedia) {
            $images[$key] = str_replace("&amp;","&", $accountMedia->getimageHighResolutionUrl());     
            $path = $images[$key];
            $imageName = $key.'.png';
            $img = public_path('insta/images/') . $imageName;
            file_put_contents($img, file_get_contents($path));
        }
        return view('gallery', compact('images'));
    }


}
