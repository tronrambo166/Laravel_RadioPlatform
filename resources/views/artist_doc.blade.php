@extends('UserPages.layout') 
@section('content')

<style type="text/css">
 .texts{color: #ededed;font-size: 14px;font-family: system-ui;}
 .texts a{color: #d3d3d3;font-size: 14px;font-family: system-ui;}
</style>

<div class="row  py-3 mt-4 texts" style=" background:#161616;">  
   
<div class="shadow border-right pl-5 col-md-3" style="background: black;">
  <div class="texts w3-sidebar w3-bar-block">
    <h4 class="pt-3 text-left text-light">Artist Documentation</h4> <hr>

  <a href="#getting" class="py-1">Getting Started</a>
  <a href="#streaming"  class="py-1">Streaming</a>
  <a href="#social"  class="py-1">Social</a>
</div>
   </div> 

   <div class="col-md-7 pl-5">

    <div id="getting" class="">

        <h6 style="color:#1aafa8;">Getting Started</h6>
        <p class="text-left justify-center">At first, you have to register to our platform. By clicking the login button at the top right corner, you will see a pop up containing login/register form. Choose Artist's sign up request under Register.<br>
            <img class="my-3" width="65%" height="300px" src="images/doc/sign-up.png">
       </p>

       <p class="text-left justify-center">After that, you will be required to fill up a form containing First name, Last name, Email, Stage name, and Telephone. Your Stage name is very important. Make sure you type the correct Stage name, otherwise we cannot find you streaming data. <br> <br>

        Now this is a basic registration to verify an artist. After your informations are verified, we'll send you an email containing an artist-Id(will be used to sign up) and a sign up link where you will complete the actual registration. Which will look like this. Use here the artist-Id you received by email. Your other info such as First name, Last name, Email, etc. should be same. That's it, you are registerd with Rewind!<br>
        <img class="my-3" width="65%" height="350px" src="images/doc/private.png">
       </p>

    </div> <hr>


    <div id="streaming" class="">
        <h6 style="color:#1aafa8;">Streaming</h6>
        <p class="text-left text-justify">At first, you have to register to our platform. By clicking the login button at the top right corner, you will see a pop up containing login/register form. Choose Artist's sign up request under Register.<br>
            <img class="my-3" width="65%" height="300px" src="images/doc/sign-up.png">
       </p>
    </div> <hr>


    <div id="social" class="">
        <h6 style="color:#1aafa8;">Social</h6>
        <p class="text-left text-justify">We have 4 social platform to help Artists monitor their insights data. Facebook, Instagram, Twitter, and TikTok. Now you have to setup these platforms for the first time to help us access your data. You can easily set up Twitter & TikTok. Facebook & Instagram might take a process.<br><br>

        <b>For Twitter:</b> When you click Twitter button, you will be taken to a page where you will be required your twitter profile Id (Instructions are given there). After add/save your twitter id, set up is done for Twitter. <br><br>

         <b>For TikTok:</b> Tt's done just by clicking the buttons and login to your TikTok account.<br><br>

          <b>For Facebook & Instagram:</b> There you need to follow the below process step by step.<br><br>
          Before entering the process - we assume that you have succesfully registered to our platform, and make sure you are logged into facebook in some other tab. <br>

          <h6>Process Begins - </h6>

          <p>
            <b class="text-primary">Step 1:</b> Go to 'https://developers.facebook.com/apps/' and you will see a invite notification to use our App. Click on 'Pending App Request' <br>
            <img class="my-3" width="75%" height="300px" src="images/doc/app-request.png">
          </p>

          Then Accept the invitation. <br>
            <img class="my-3" width="75%" height="100px" src="images/doc/accept.png">
         


          <p class="step mt-4">
            <b class="text-primary">Step 2:</b> Again go to 'https://developers.facebook.com/apps/' and click the REWIND app to access. <br>
            <img class="my-3" width="75%" height="300px" src="images/doc/click-app.png"> <br>

            Then in the App dashboard, click on Graph Api Explorer from Tools
            <img class="my-3" width="75%" height="300px" src="images/doc/graph-tool.png">
          </p>


          <p>
            <b class="text-primary">Step 3:</b> Now in the Graph API, you have to add the follwing permissions.<br><br>
             <b>Add below permissions</b> <br>
                -Read insights (do not add if already added)<br>
                -pages_show_list<br>

                -instagram_basic<br>
                -instagram_manage_insights<br>
                -business_management<br>
                -pages_read_engagement<br><br>

             You can search & add permissions like the image below <br>
            <img class="my-3" width="75%" height="350px" src="images/doc/add-permissions.png">
          </p>



          <p>
            <b class="text-primary">Last Step:</b> Now you are pretty much done, only requird to select which page you want REWIND to access <br>

            After added all permissions, click on 'User Token' & select 'Get Page Access Token' shown in the image below.<br>
            <img class="my-3" width="75%" height="300px" src="images/doc/get-page.png"><br><br>

            After that, a pop up will open and ask you to select the page. You need to select (tick) the page you want to get data from and click 'Next' like the below example. Note: (Your page must be linked with Instagram)<br>
             <img class="my-3" width="75%" height="300px" src="images/doc/page-selected.png"><br><br>

             That's it, after clicking next, click 'Done' on the next page and then click 'Ok' to finish the process. You've successfully set-up your Facebook & Instagram page for Rewind. Now you can go back to rewind and see the insights.
          </p>

    </div>

       
   </div>    
           

           
          
</div>


<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>

          @endsection
        
       

