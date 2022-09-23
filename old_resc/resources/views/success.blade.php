
@php
use App\Models\User;
$user=DB::table('users')->where('email',Session::get('logged'))->first();
$stage_name=$user->stage_name;  echo $stage_name; 
$channel_id = 246131;     
@endphp

<!doctype html>
        <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf8_decode()">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <style>

     .tabil{margin: auto; text-align: center; background: aliceblue;}

          .text-center{
          text-align:center;
          }
          .title{
          background-color:#f7f7f7;
          padding-top:15px;
          padding-bottom:5px;
          font-size:25px;
          font-weight:200;
          }
        .text-left{
            text-align:left !important;
        }
        .table td{
        font-size:20px; padding: 33px;
        }
       
        .wrapper {
              display: flex;
            }
        .left-div{
          flex: 0 0 65%;
        }
        .right-div{
           flex: 1;
        }
      </style>

    <title>Breakdown!</title>
  </head>
  <body  width="100%">
    <h2 class="text-center" style="background:black; padding: 15px; color:white;">@if($channel_id = 246131)  Radio Station: Radio Jambo @endif</h2>

    <h3 class="text-center">Artist: {{$stage_name}} songs breakdown last 5 days</h3>

  <table class="shadow my-3 w-100 bg-white table tabil">
  <thead>
    <tr class=" bg-light w-100">


      <th> Title</th>
      <th> Album</th>
      <th> Duration</th>
      <th> Played on</th>
      <th style="padding-right:15px;"> Released date</th>
     
      
    </tr>
  </thead>
  <tbody> 

    @foreach($titles as $k => $arr)
   @if($arr['artist']==$stage_name)

    <tr class="border">
      
      
      <td>{{$arr['title']}}</td>
      <td>{{$arr['album']}}</td>
      <td>@if ($arr['duration']<10) {{$arr['duration']}} @else {{round($arr['duration']/60)}} @endif mins</td>
       <td>{{$arr['timestamp']}}</td>
        <td>{{$arr['release_date']}}</td>
    </tr>

     @endif
     @endforeach
    
  </tbody>
</table>


  </body>
</html> @php  @endphp
		
		
	  
		
		
	