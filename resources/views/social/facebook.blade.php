@extends('layout') 
@section('page')

<style type="text/css"> .smalls{color: black;font-size: 13px;} </style>
@php $data = Session::get('fb_info');  @endphp
<div class=" mx-auto" style="width:95%; background:#161616;" >  
   <h4 class="text-center my-3 text-light ">Facebook Insights <a href="{{route('youtube')}}" class="float-right text-light rounded-0 mr-2 px-4 btn btn-outline-dark font-weight-bold my-1">Back</a>
   </h4> <hr>


<div class="row">           
<div class="col-sm-8">

   <div class="row bg-light mx-0 py-2">
                      <div class="col-sm-3 link">
                      <button  id="gender" class="font-weight-bold text-dark btn btn-outline-success smalls" onclick="gender();"  value="artist"> Audience by Gender</button>  </div> 

                       <div class="col-sm-3 link">
                      <button  id="country" class=" smalls font-weight-bold text-dark btn btn-outline-primary" onclick="country();"  value="artist"> Audience by Country</button>  </div>
                                            <div class="col-sm-3 ">
                      <button  id="city" class=" smalls font-weight-bold text-dark btn btn-outline-warning" onclick="city();"  value="artist"> Audience by City</button>
                       </div>
                            
                       <div class="col-sm-3 ">
                      <button  id="reach" class=" smalls font-weight-bold text-dark btn btn-outline-danger" onclick="reach();"  value="artist"> Talking About</button> 
                   </div>
             </div>      


<?php

 $male= Session::get('male'); $female= Session::get('female');
  if(!isset($male['55-64'])) $age55 = 0; else  $age55 = $male['55-64']; 
  if(!isset($female['55-64'])) $age55f = 0; else  $age55f = $female['55-64'];
  
   $city= Session::get('fans_city'); //echo print_r($city); exit;
   $country= Session::get('fans_country'); 

   $cityArray=array();$countryArray=array(); $ReachArray=array();

foreach($city as $key => $value)
   $cityArray[]= array("label"=> $key, "y"=> $value);

 foreach($country as $key => $value)
   $countryArray[]= array("label"=> $key, "y"=> $value);


//SETTING END
 
$dataPoints1 = array(
  array("label"=> "13-17", "y"=> $male['13-17']),
  array("label"=> "18-24", "y"=> $male['18-24']),
  array("label"=> "25-34", "y"=> $male['25-34']),
  array("label"=> "35-44", "y"=> $male['35-44']),
  array("label"=> "45-54", "y"=> $male['45-54']),
  array("label"=> "55-64", "y"=> $age55),
  array("label"=> "65+", "y"=> $male['65+'])
);
$dataPoints2 = array(
  array("label"=> "13-17", "y"=> $female['13-17']),
  array("label"=> "18-24", "y"=> $female['18-24']),
  array("label"=> "25-34", "y"=> $female['25-34']),
  array("label"=> "35-44", "y"=> $female['35-44']),
  array("label"=> "45-54", "y"=> $female['45-54']),
  array("label"=> "55-64", "y"=> $age55f),
  array("label"=> "65+", "y"=> $female['65+'])
);

//CITY
$dataPointsCity1 = $cityArray;
//COUNTRY
$dataPointscountry1 = $countryArray;

  
?>
 
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2",
  title:{
    text: "Facebook Audience Insights by Age and Gender"
  },
  axisY:{
    includeZero: true
  },
  legend:{
    cursor: "pointer",
    verticalAlign: "center",
    horizontalAlign: "right",
    itemclick: toggleDataSeries
  },
  data: [{
    type: "column",
    name: "Male",
    indexLabel: "{y}",
    yValueFormatString: "#0.##",
    showInLegend: true,
    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
  },{
    type: "column",
    name: "Female",
    indexLabel: "{y}",
    yValueFormatString: "#0.##",
    showInLegend: true,
    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
function toggleDataSeries(e){
  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  }
  else{
    e.dataSeries.visible = true;
  }
  chart.render();
}
 
 // CITY CHART

var chartCity = new CanvasJS.Chart("chartContainerCity", {
  animationEnabled: true,
  theme: "light2",
  title:{
    text: "Facebook Audience Insights by City"
  },
  axisY:{
    includeZero: true
  },
  legend:{
    cursor: "pointer",
    verticalAlign: "center",
    horizontalAlign: "right",
    itemclick: toggleDataSeries
  },
  data: [{
    type: "column",
    name: "City",
    indexLabel: "{y}",
    yValueFormatString: "#0.##",
    showInLegend: true,
    dataPoints: <?php echo json_encode($dataPointsCity1, JSON_NUMERIC_CHECK); ?>
  }]
});
chartCity.render();
 
function toggleDataSeries(e){
  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  }
  else{
    e.dataSeries.visible = true;
  }
  chartCity.render();
}
 //CITY 


  // COUNTRY CHART

var chartContainerCountry = new CanvasJS.Chart("chartContainerCountry", {
  animationEnabled: true,
  theme: "light2",
  title:{
    text: "Facebook Audience Insights by COUNTRY"
  },
  axisY:{
    includeZero: true
  },
  legend:{
    cursor: "pointer",
    verticalAlign: "center",
    horizontalAlign: "right",
    itemclick: toggleDataSeries
  },
  data: [{
    type: "column",
    name: "Country",
    indexLabel: "{y}",
    yValueFormatString: "#0.##",
    showInLegend: true,
    dataPoints: <?php echo json_encode($dataPointscountry1, JSON_NUMERIC_CHECK); ?>
  }]
});
chartContainerCountry.render();
 
function toggleDataSeries(e){
  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  }
  else{
    e.dataSeries.visible = true;
  }
  chartContainerCountry.render();
}
 //COUNTRY 


}


  
</script>
<div class="w-100" id="gender_div">
<div class="mt-2 mx-auto" id="chartContainer" style="height: 370px; width: 100%;"></div>
</div>

<div class=" " id="city_div">
<div class="mt-2" id="chartContainerCity" style="height: 370px; width: 100%;"></div>
</div>

<div class=" " id="country_div">
<div class="mt-2" id="chartContainerCountry" style="height: 370px; width: 100%;"></div>
</div>


<div class="" id="reach_div">


<div class="mt-2 px-5 bg-light" id="" style="height: 370px; width: 100%;">

  <h3 class="bg-light text-primary">Total Likes</h3>

  <div class="row text-dark "> 
  <div class="col-md-4"><h6 class="font-weight-bold">Daily new Likes: </h6></div>
  <div class="col-md-6"><h6 class="font-weight-bold">{{Session::get('daily_new_likes')}}</h6></div>
  </div>

   <div class="row text-dark "> 
  <div class="col-md-4"><h6 class="font-weight-bold">Weekly new Likes: </h6></div>
  <div class="col-md-6"><h6 class="font-weight-bold">{{Session::get('weekly_new_likes')}}</h6></div>
  </div>

   <div class="row text-dark "> 
  <div class="col-md-4"><h6 class="font-weight-bold">Moontly new Likes: </h6></div>
  <div class="col-md-6"><h6 class="font-weight-bold">{{Session::get('monthly_new_likes')}}</h6></div>
  </div>


  <h3 class="bg-light  my-4 text-primary">People talking about this page</h3>

  <div class="row text-dark "> 
  <div class="col-md-4"><h6 class="font-weight-bold">Daily new talking: </h6></div>
  <div class="col-md-6"><h6 class="font-weight-bold">{{Session::get('daily_new_taking')}}</h6></div>
  </div>

   <div class="row text-dark "> 
  <div class="col-md-4"><h6 class="font-weight-bold">Weekly new talking: </h6></div>
  <div class="col-md-6"><h6 class="font-weight-bold">{{Session::get('weekly_new_taking')}}</h6></div>
  </div>

   <div class="row text-dark "> 
  <div class="col-md-4"><h6 class="font-weight-bold">Moontly new talking: </h6></div>
  <div class="col-md-6"><h6 class="font-weight-bold">{{Session::get('monthly_new_taking')}}</h6></div>
  </div>

</div>
</div>
</div>


<!-- TOP 20 PAGES -->
<div class="col-md-4 bg-light"  style="overflow-y:auto;height: 427px;">
  
  <h3 class="mx-2 py-2 h5">Top 20 pages with similar audience</h3>

  @php $max_factor=25; $max_match=95;$counter=0;$counter_c=0;$counter_cc=0; 

  $my_ages = explode(',',$audience_me->age);
  $my_cities = explode(';',$audience_me->city);
  $my_countries = explode(',',$audience_me->country);
  @endphp
  
  @foreach($audience_all as $all)
  @php 
  $ages = explode(',',$all->age);
  $cities = explode(';',$all->city);
  $countries = explode(',',$all->country);

//AGES
  foreach($ages as $age){
  foreach($my_ages as $m_age){
  if($age === $m_age)
  {  $counter++; }
}}
  if($counter>6)
  $age_percent = 99;
  else $age_percent = ($counter/6)*95; $counter =0;

//CITY
  foreach($cities as $city){
  foreach($my_cities as $m_city){
  if($city == $m_city)
  {  $counter_c++; }
}}
  if($counter_c>$max_factor)
  $city_percent = 99;
  else $city_percent = ($counter_c/$max_factor)*95; $counter_c =0;

//COUNTRY
  foreach($countries as $country){
  foreach($my_countries as $m_country){
  if($country == $m_country)
  {  $counter_cc++; }
}}
  if($counter_cc>$max_factor)
  $country_percent = 99;
  else $country_percent = ($counter_cc/$max_factor)*95; $counter_cc =0;

  @endphp

  


  <div class="row mx-2">
    <p class="small font-weight-bold text-info">{{$all->business_name}}</p> <p class="text-muted small ml-auto">{{round(($country_percent+$city_percent+$age_percent)/3) }}% matching</p>
  </div>

  @endforeach


</div>
 <button class="btn btn-dark font-weight-bold border border-success ml-auto">Download Report</button>



 </div>
</div>




<!--_________________________________________________________________________________________-->   

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</div>


        
 <div class="col-sm-5 chart2">




</div>

         </div>  


  

<div style="width:100%; background:#161616;" class=" py-5"></div>



        
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

 <script type="text/javascript">

  $(window).on("load", hide);
  function hide(){ 
    $('#city_div').hide();
     $('#country_div').hide();
      $('#reach_div').hide();
      $('#gender').addClass('btn-success');
       }
     

    function gender(){
    $('#gender_div').show();
    $('#country_div').hide();
    $('#city_div').hide();
    $('#reach_div').hide();

    $('#country').removeClass('btn-success');
    $('#city').removeClass('btn-success');
    $('#reach').removeClass('btn-success');

    $('#gender').addClass('btn-success');
    }

    function country(){
    $('#gender_div').hide();$('#country_div').removeClass('collapse');
    $('#country_div').show();
    $('#city_div').hide();
    $('#reach_div').hide();

    $('#country').addClass('btn-success');
    $('#city').removeClass('btn-success');
    $('#reach').removeClass('btn-success');

    $('#gender').removeClass('btn-success');
    
    }


     function city(){
    $('#gender_div').hide();
    $('#country_div').hide();
    $('#city_div').show();
    $('#reach_div').hide();

    $('#country').removeClass('btn-success');
    $('#city').addClass('btn-success');
    $('#reach').removeClass('btn-success');

    $('#gender').removeClass('btn-success');
    }


     function reach(){
    $('#gender_div').hide();
    $('#country_div').hide();
    $('#city_div').hide();
    $('#reach_div').show();

    $('#country').removeClass('btn-success');
    $('#city').removeClass('btn-success');
    $('#reach').addClass('btn-success');
    $('#gender').removeClass('btn-success');
    }




</script>



          @endsection
        
       
