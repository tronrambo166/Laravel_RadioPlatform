<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Models\admins;
use App\Models\User;
use App\Models\visitors;
use App\Models\liveSongs;
use App\Models\mymusic;
use App\Models\albums;
use Mail;
use Session;
class AdminController extends Controller
{

  public function login()
    {  
        return view('admin.login'); 
    }

     public function logout()
    {  
        Session::forget('admin');
     //$request->session()->invalidate();
     //$request->session()->regenerateToken();
        return redirect('admin/login'); 
    }

     public function index_admin()
    {          
        $artists= User::get();
        $users= visitors::get();
       
        return view('admin.index_admin', compact('artists','users')); 
 }




 // Artists

public function artists()
    {       
        $artists= User::get();
  return view('admin.artists', compact('artists'));       
    }


    public function approve($id)
 {      
       User::where('id',$id)->update(['approved' => 1]);
       $artist=User::where('id',$id)->first();

       /* Send Email
    $email=$artist->email;
        $info=['art_id'=>$artist->art_id, 'email' => $email];
        $user['to']= $email;
        Mail::send('mails.approve_mail', $info, function($msg) use ($user){
            $msg->to($user['to']);
            $msg->subject('Approve Mail');

        });
         Send Email */
    

       return back()->with('success', "Approved!"); 
   }


    public function restrict($id)
 {     
       User::where('id',$id)->update(['approved' => 0]);
       return back()->with('success', "Restricted!"); 
   }



 public function del_artist($id)
    {           
       User::where('id', $id)->delete();
       return back()->with('success', "Deleted!"); 
 }

 // Artists



public function users()
    {       
    $users= visitors::get();
  return view('admin.users', compact('users'));       
    }


public function songs()
    {       
   $static20=liveSongs::get();
   $lastDay=DB::table('last_day_songs')->get();
  return view('admin.songs',compact('static20','lastDay'));     
    }







//** Forgot

public function forgot($remail)
    { 

         return view('admin.forgot_password',compact('remail'));
     
    }


public function send_reset_email(Request $request)
    {

        $remail=$request->email;   
        

        // Send Email

        $info=['Name'=>'Dele', 'email' => $remail];
        $user['to']= $remail;
        Mail::send('admin.mail', $info, function($msg) use ($user){

            $msg->to($user['to']);
            $msg->subject('Test Mail');

        });

        echo "Check your email"; exit;

        // Send Email

    }


public function reset(Request $request, $remail)
    { echo "hello";

       $email=$remail;
       $password_1=$request->password; 
       $password=$request->c_password; 

       if($password_1==$password) {
     $password_1= Hash::make($password_1);
     $update= DB::table('admins')->where('email', $email)
     -> limit(1)->update(['password'=> $password_1]);

     if($update) {Session::put('reset', 'password reset success!');return redirect('admin/login'); }
       }    
          else {
            Session::put('wrong_pwd', 'password do not match! try again');
          return redirect()->back();
      }

    }


//______________________________________________________________________________

     public function adminLogin(Request $formData)
{      
$email = $formData->email;
$password = $formData->password;
$user= admins::where('email', $email)->get(); 
$check_user=json_decode($user);
//print_r($check_user); echo $check_user[0]->password; exit;

if($user->count() >0 ) {
$db_password=$check_user[0]->password; //opd_admin
if(password_verify($password, $db_password)) { 
    Session::put('admin','Logged!'); 
    return redirect('admin/index_admin'); }
else{
    Session::put('log_err','Password wrong!'); return redirect()->back();
   

}
    }

      Session::put('log_err','User dont exist!'); return redirect()->back();

}




    public function adminLogout(Request $request)
{
    Auth::guard('admin')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('admin/login');
}

    //** Login attempt and Custom Authentication




// Remove special chars
    function clean($string) {
   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}




      public function get_sugges($sText) {   
      $searchName=$sText; 
      $cat=DB::table('categories')->where('name', 'like', '%'.$searchName.'%')->get();
      $cats=DB::table('categories')->where('name', 'like', '%'.$searchName.'%')->first();

      if($cat->count()>0) $cat_doc_id=$cats->id; else $cat_doc_id=0;

      $result=DB::table('doctors')->where('name', 'like', '%'.$searchName.'%')->
      orWhere('category_id',$cat_doc_id)->get();

         return response()->json([ 'data'=>$result ]);

     }


}