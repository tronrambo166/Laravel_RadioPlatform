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
use App\Models\Instagram;
use Laravel\Socialite\Facades\Socialite;
use Phpfastcache\Helper\Psr16Adapter;
use Atymic\Twitter\Twitter as TwitterContract;
use Illuminate\Http\JsonResponse;
use Twitter;

class socialController extends Controller
{
    public $i=0, $j=0, $cnt2=0, $cnt=1, $k=0;

//FACEBOOK
public function facebook() { 


//GramInsta
	    $driver=Session::get('driver');
		if(isset($driver) && $driver =='insta')      { 	
			// insta fb id =200952529947077
		//"https://graph.facebook.com/v15.0/134895793791914?fields=instagram_business_account&access_token={access-token}"

		$pageId=17841444949513102;// insta business id =17841444949513102
		// insta fb id =200952529947077		
		 $data = array();
         $user = Socialite::driver('facebook')->user(); 
         $userToken = $user->token;
         $userId = $user->id; //return $userToken.'`````'.$userId;
		
        /*$curl=curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL=> 'https://graph.facebook.com/'.$pageId.'/insights?metric=impressions,reach,profile_views&period=day&access_token='.$userToken,
        CURLOPT_RETURNTRANSFER=> TRUE,
        CURLOPT_ENCODING=> '',
        CURLOPT_MAXREDIRS=> 10,
        CURLOPT_TIMEOUT=> 30,
        CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST=> 'GET',
        CURLOPT_HTTPHEADER=> array(
        //'content-type:application/json'    
        ),
        ));

        $response=curl_exec($curl); //dd($response);
        $response=json_decode($response,true);
        $data['impressions_today'] = $response['data'][0]['values'][1]['value'];
        $data['impressions_yesterday'] = $response['data'][0]['values'][0]['value']; 
		
		$data['reach_today'] = $response['data'][1]['values'][1]['value'];
        $data['reach_yesterday'] = $response['data'][1]['values'][0]['value']; 
		
		$data['profile_views_today'] = $response['data'][2]['values'][1]['value'];
        $data['profile_views_yester'] = $response['data'][2]['values'][0]['value']; 
        
        //echo '<pre>';print_r($data);echo '<pre>'; exit; 
		
		
		
		//FOLLOWERS
		
		 $curl=curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL=> 'https://graph.facebook.com/'.$pageId.'?fields=business_discovery.username(rewinsta283){followers_count,media_count}&access_token='.$userToken,
        CURLOPT_RETURNTRANSFER=> TRUE,
        CURLOPT_ENCODING=> '',
        CURLOPT_MAXREDIRS=> 10,
        CURLOPT_TIMEOUT=> 30,
        CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST=> 'GET',
        CURLOPT_HTTPHEADER=> array(
        //'content-type:application/json'    
        ),
        ));

        $response=curl_exec($curl); //dd($response);
        $response=json_decode($response,true);
       
        
        //echo '<pre>';print_r($response);echo '<pre>'; exit;
           $data['followers'] = $response['business_discovery']['followers_count'];
         //$data['media'] = $response['business_discovery']['followers_count'];		
		   Session::put('instaInfo',$data);
		
        Session::forget('driver');
        //return redirect()->route('social_instagram'); */
		//FOLLOWERS
		
		
		//IMPRESSION REACH last 14 days
			
		$curl=curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL=> 'https://graph.facebook.com/'.$pageId.'/insights?metric=impressions,reach&period=days_28&since=2022-11-02&until=2022-12-02&access_token='.$userToken,
        CURLOPT_RETURNTRANSFER=> TRUE,
        CURLOPT_ENCODING=> '',
        CURLOPT_MAXREDIRS=> 10,
        CURLOPT_TIMEOUT=> 30,
        CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST=> 'GET',
        CURLOPT_HTTPHEADER=> array(
        //'content-type:application/json'    
        ),
        ));

        $response=curl_exec($curl); //dd($response);
        $response=json_decode($response,true);
       
        
        //echo '<pre>';print_r($response);echo '<pre>'; exit;
           $data['reach_14'] = $response['data'][1]['values'];
        	
		   Session::put('audience_reach',$data['reach_14']);
		
		
		
		//City/Country Age/Gender
			
		 $curl=curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL=> 'https://graph.facebook.com/'.$pageId.'/insights?metric=audience_city,audience_country,audience_gender_age,audience_locale&period=lifetime&access_token='.$userToken,
        CURLOPT_RETURNTRANSFER=> TRUE,
        CURLOPT_ENCODING=> '',
        CURLOPT_MAXREDIRS=> 10,
        CURLOPT_TIMEOUT=> 30,
        CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST=> 'GET',
        CURLOPT_HTTPHEADER=> array(
        //'content-type:application/json'    
        ),
        ));

        $response=curl_exec($curl); //dd($response);
        $response=json_decode($response,true);
       
        
        //echo '<pre>';print_r($response);echo '<pre>'; exit;

        //SORTING
        if($response['data'][2]['values'][0]['value'])
        $data['audience_gender_age'] = $response['data'][2]['values'][0]['value'];
        $data['audience_city'] = $response['data'][0]['values'][0]['value'];
        $data['audience_country'] = $response['data'][1]['values'][0]['value'];

        $maleGram = array(); $femaleGram = array();
        $resultGram = $data['audience_gender_age'];
        foreach($resultGram as $key => $value){
            $key = explode('.',$key);
            if($key[0] == 'M') $maleGram[$key[1]] = $value;
            else               $femaleGram[$key[1]] = $value;
        } 
        Session::put('maleGram',$maleGram); Session::put('femaleGram',$femaleGram);
        Session::put('audience_city',$data['audience_city']); 
         Session::put('audience_country',$data['audience_country']);
        Session::save();
         //echo '<pre>';print_r($maleGram);echo '<pre>'; exit;
           
        //$data['followers'] = $response['business_discovery']['followers_count'];
         	
		   Session::put('instaInfo',$data);
		
        Session::forget('driver');
        return redirect()->route('social_instagram');
		

		}	
//GramInsta




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
	
	$data['tweets'] = $result->data;
     //echo '<pre>'; print_r($data); echo '<pre>'; exit;

    $result = $querier
    ->withOAuth2Client()
    ->get('users/1587075783545217025/followers');
	 $data['followers'] = $result->meta->result_count;
	 
	 return view('social.twitter',compact('data'));

    }


     public function instagram()
    {
		// insta fb id =200952529947077
		//"https://graph.facebook.com/v15.0/134895793791914?fields=instagram_business_account&access_token={access-token}"

		$pageId=17841444949513102;// insta business id =17841444949513102
		// insta fb id =200952529947077		
		 $data = array();
         $user = Socialite::driver('facebook')->user(); 
         $userToken = $user->token;
         $userId = $user->id; //return $userToken.'`````'.$userId;
		
        $curl=curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL=> 'https://graph.facebook.com/'.$pageId.'/insights?metric=impressions,reach,profile_views&period=day&access_token='.$userToken,
        CURLOPT_RETURNTRANSFER=> TRUE,
        CURLOPT_ENCODING=> '',
        CURLOPT_MAXREDIRS=> 10,
        CURLOPT_TIMEOUT=> 30,
        CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST=> 'GET',
        CURLOPT_HTTPHEADER=> array(
        //'content-type:application/json'    
        ),
        ));

        $response=curl_exec($curl); //dd($response);
        $response=json_decode($response,true);
        $data['impressions_today'] = $response['data'][0]['values'][1]['value'];
        $data['impressions_yesterday'] = $response['data'][0]['values'][0]['value']; 
		
		$data['reach_today'] = $response['data'][1]['values'][1]['value'];
        $data['reach_yesterday'] = $response['data'][1]['values'][0]['value']; 
		
		$data['profile_views_today'] = $response['data'][2]['values'][1]['value'];
        $data['profile_views_yester'] = $response['data'][2]['values'][0]['value']; 
        
        //echo '<pre>';print_r($data);echo '<pre>'; exit; 
		
		
		
		//FOLLOWERS
		
		 $curl=curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL=> 'https://graph.facebook.com/'.$pageId.'?fields=business_discovery.username(rewinsta283){followers_count,media_count}&access_token='.$userToken,
        CURLOPT_RETURNTRANSFER=> TRUE,
        CURLOPT_ENCODING=> '',
        CURLOPT_MAXREDIRS=> 10,
        CURLOPT_TIMEOUT=> 30,
        CURLOPT_HTTP_VERSION=> CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST=> 'GET',
        CURLOPT_HTTPHEADER=> array(
        //'content-type:application/json'    
        ),
        ));

        $response=curl_exec($curl); //dd($response);
        $response=json_decode($response,true);
       
        
        //echo '<pre>';print_r($response);echo '<pre>'; exit;
           $data['followers'] = $response['business_discovery']['followers_count'];
         //$data['media'] = $response['business_discovery']['followers_count'];		
		   Session::put('instaInfo',$data);
		

        return redirect()->route('social_instagram');

   
    }
	
    public function gotoInsta()
    {	$insta=Instagram::get();
        return view('social.instagram',compact('insta'));
    }
	
	
	
	
	 public function tiktok()
    {
		$redirect_uri ='https://muziqyrewind.com/social/tiktok/callback';
		$client_key='aw89q2eh5tn914vy';
		
        $curl=curl_init();
        curl_setopt_array($curl, array(
       // CURLOPT_URL=> 'https://www.tiktok.com/auth/authorize?client_key='.$client_key.'&response_type=code&scope=user.info.basic,video.list&redirect_uri='.$redirect_uri.'&state=Staging',
          CURLOPT_URL=> 'https://www.tiktok.com/auth/authorize?client_key=awudsc70wb3h7hsw&response_type=code&scope=user.info.basic,video.list&redirect_uri=muziqyrewind.com&state=Production',

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

         $response=curl_exec($curl);//  
		 //dd($response);
		 $res=explode('"',$response); //echo $res[1];
		 //header('location:https://www.tiktok.com/'.$res[1]);
		 echo "<script> 
		 window.location.href='https://www.tiktok.com/$res[1]' </script>";
        //$response=json_decode($response,true);       
        //echo '<pre>';print_r($response);echo '<pre>';exit;
    }
	
	public function tiktok_callback()
    { 
	return 'inside';
	}


}
