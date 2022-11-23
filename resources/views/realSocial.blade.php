@extends('layout') 
@section('page')



<div class="row mx-auto" style="width:90%; background:#161616;" >  
         <div class="col-md-12"> 
             <h4 class="text-center mt-2 text-light">Rewind Cloud Monitoring</h4> <hr> 

 <table class="shadow mb-3 w-100 bg-white table tabil m-auto">
  <thead>
    <tr class=" bg-dark w-100 m-auto text-center">
       <div class="links m-auto text-center">
        <a href="{{route('login.facebook')}}" class="mx-2 btn btn-outline-danger  rounded">Facebook</a>
         <a href="{{route('login.instagram')}}" class="mx-2 btn btn-outline-success rounded">Instagram</a>
          <a href="{{route('twitter')}}" class="mx-2 btn btn-outline-primary rounded">Twitter</a>
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

        <a href='{SERVER_ENDPOINT_OAUTH}'>Continue with TikTok</a>
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
        
       

