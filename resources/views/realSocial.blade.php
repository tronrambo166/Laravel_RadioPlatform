@extends('layout') 
@section('page')

@php
//INSTA ID CHECK
            $art=DB::table('users')->where('email', Session::get('logged'))->first();
            $check_insta =$art->insta_pageid_of_fb; 
            $check_twit =$art->twitter_id; 
//INSTA ID CHECK 
@endphp

@if(Session::has('social_id')) 
 <div class=" w-50 m-auto text-center bg-light"><p class="text-success">{{Session::get('social_id')}} @php Session::forget('social_id'); @endphp </p> </div>
  @endif



<div class="row mx-auto" style="width:90%; background:#161616;" >  
         <div class="col-md-10"> 
             <h4 class="text-center mt-2 text-light">Rewind Cloud Monitoring</h4> <hr> 

 <table class="shadow mb-3 w-100 bg-white table tabil m-auto">
  <thead>
    <tr class=" bg-dark w-100 m-auto text-center">
       <div class="links m-auto text-center">
        <a href="{{route('login.facebook')}}" class="mx-2 btn btn-outline-danger  rounded">Facebook</a>

        @if($check_insta == null)
         <a onclick="alert('Please add your page Id first');"href="{{route('socialIds','Insta')}}" class="mx-2 btn btn-outline-success rounded">Instagram</a>
         @else
         <a href="{{route('login.instagram')}}" class="mx-2 btn btn-outline-success rounded">Instagram</a>
         @endif


         @if($check_twit == null)
         <a onclick="alert('Please add your profile Id first');"href="{{route('socialIds','Twitter')}}" class="mx-2 btn btn-outline-success rounded">Twitter</a>
         @else
         <a href="{{route('twitter')}}" class="mx-2 btn btn-outline-primary rounded">Twitter</a>
         @endif

          <a href="{{route('tiktok')}}" class="mx-2 btn btn-outline-warning  rounded">TikTok</a>
           
         
     </div>  
    </tr>


    <tr class=" bg-dark w-100 mx-auto text-center">
       
    </tr>


  </thead>
  <tbody>
    <tr class="border">
   
    </tr>
    
  </tbody>
</table>

<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>

             </div>  


 <div class="col-md-2">
  <a style="font-size: 11px;" href="{{route('socialIds','Twitter')}}" class="py-1 small mx-2 btn btn-light rounded">Update Twitter id</a>

   <a style="font-size: 11px;" href="{{route('socialIds','Insta')}}" class="py-1 pr-4 mt-2 small mx-2 btn btn-light rounded">Update Insta id</a>

 </div>            

      
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script type="text/javascript">
  $('#success').hide();
  function success_msg(){
    console.log('success');
    $('#success').show();
  }
  
//TikTok
const csrfState = Math.random().toString(36).substring(2);

const express = require('express');
const app = express();
const fetch = require('node-fetch');
const cookieParser = require('cookie-parser');
const cors = require('cors');

app.use(cookieParser());
app.use(cors());
app.listen(process.env.PORT || 5000).

const CLIENT_KEY = 'awudsc70wb3h7hsw'; // this value can be found in app's developer portal

app.get('/oauth', (req, res) => {
    const csrfState = Math.random().toString(36).substring(2);
    res.cookie('csrfState', csrfState, { maxAge: 60000 });

    let url = 'https://www.tiktok.com/auth/authorize/';

    url += '?client_key={CLIENT_KEY}';
    url += '&scope=user.info.basic,video.list';
    url += '&response_type=code';
    url += '&redirect_uri={https://muziqyrewind.com/social/tiktok/callback}';
    url += '&state=' + csrfState;

    res.redirect(url);
})
</script>

          @endsection
        
       

