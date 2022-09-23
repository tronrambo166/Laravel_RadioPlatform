@extends('layout') 
@section('page')

@php 
use App\Models\User;
$user=DB::table('users')->where('email',Session::get('logged'))->first();
$stage_name=$user->stage_name;       
@endphp

<style> 
   #calmonth, #calyear{
    background: black;
    color: white;
    }
.calsq.day{background: #1e1e1e;}
#calformsave{background: green;}
  
    
    </style>
}
}

 <script src="calander/5-calendar.js"></script>

 <div class="row mx-auto" style="width:90%; background:black;">
  <h4 class="text-center mt-2 text-light">Rewind Cloud Monitoring</h4> <hr> 
 

<div id="calPeriod" style="background: black">><?php
      // (A1) MONTH SELECTOR
      // NOTE: DEFAULT TO CURRENT SERVER MONTH YEAR
      $months = [
        1 => "January", 2 => "Febuary", 3 => "March", 4 => "April",
        5 => "May", 6 => "June", 7 => "July", 8 => "August",
        9 => "September", 10 => "October", 11 => "November", 12 => "December"
      ];
      $monthNow = date("m");
      echo "<select id='calmonth'>";
      foreach ($months as $m=>$mth) {
        printf("<option value='%s'%s>%s</option>",
          $m, $m==$monthNow?" selected":"", $mth
        );
      }
      echo "</select>";

      // (A2) YEAR SELECTOR
      echo "<input type='number' id='calyear' value='".date("Y")."'/>";
    ?></div>

    <!-- (B) CALENDAR WRAPPER -->
    <div id="calwrap"></div>

    <!-- (C) EVENT FORM -->
    <div id="calblock"><form id="calform">
      <input hidden type="number" id="artist_id" name="artist_id" value="{{$user->id}}">
      
      <input type="hidden" name="req" value="save"/>
      <input type="hidden" id="evtid" name="eid"/>
      <label for="start">Date Start</label>
      <input type="datetime-local" id="evtstart" name="start" required/>
      <label for="end">Date End</label>
      <input type="datetime-local" id="evtend" name="end" required/>
      <label for="txt">Event</label>
      <textarea id="evttxt" name="txt" required></textarea>
      <label for="color">Color</label>
      <input type="color" id="evtcolor" name="color" value="#e4edff" required/>
      <input type="submit" id="calformsave" value="Save"/>
      <input type="button" id="calformdel" value="Delete"/>
      <input type="button" id="calformcx" value="Cancel"/>
    </form></div>

    <div class="clearfix py-3" > </div>

      </div>


          @endsection
        
       

