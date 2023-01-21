@extends('layout') 
@section('page')

<style type="text/css"> .smalls{color: black;font-size: 13px;} </style>

@php $data = Session::get('instaInfo'); @endphp
<div class=" mx-auto" style="width:95%; background:#161616;" >  
   <h4 class="text-center mt-2 text-light w-75">Instagram Report <a href="{{route('social')}}" class="float-right text-light rounded-0 mr-2 px-4 btn btn-outline-dark font-weight-bold my-1">Back</a>
   </h4> <hr>


    <div class="row bg-light mx-0 py-2" style="width:83%;">          

                     <div class="col-sm-3">
                     

                      <button  id="gender" class="font-weight-bold text-dark btn btn-outline-success smalls" onclick="gender();"  value="artist"> Audience by Gender</button>  </div> 

                       <div class="col-sm-3 link">
                      <button  id="country" class="font-weight-bold text-dark btn btn-outline-success smalls" onclick="country();"  value="artist"> Audience by Country</button>  </div> 
                      
                                            <div class="col-sm-3 ">
                      <button  id="city" class="font-weight-bold text-dark btn btn-outline-success smalls" onclick="city();"  value="artist"> Audience by City</button>
                       </div>
                            
                      
                                            <div class="col-sm-3 ">
                      <button  id="reach" class="font-weight-bold text-dark btn btn-outline-success smalls" onclick="reach();"  value="artist"> Reach</button>  </div>                     
                    
             </div>

   


<div class="row">           
<div class="col-sm-10 ">

<?php

 $male= Session::get('maleGram'); $female= Session::get('femaleGram');
  if(!isset($male['55-64'])) $age55 = 0; else  $age55 = $male['55-64']; 
  if(!isset($female['55-64'])) $age55f = 0; else  $age55f = $female['55-64'];
  
   $city= Session::get('audience_city'); //echo print_r($city); exit;
   $country= Session::get('audience_country');
   $reach= Session::get('audience_reach');

   $cityArray=array();$countryArray=array(); $ReachArray=array();

foreach($city as $key => $value)
   $cityArray[]= array("label"=> $key, "y"=> $value);

 foreach($country as $key => $value)
   $countryArray[]= array("label"=> $key, "y"=> $value);

 foreach($reach as $key => $value){
  list($date) = explode(':',$value['end_time']);
  $date = explode('T',$date); $date=explode('-',$date[0]);
  $date = $date[1].'-'.$date[2];
   $ReachArray[]= array("y"=> $value['value'], "label"=> $date);
 }

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
//REACH
$dataPointsReach1 = $ReachArray;
  
?>
 
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2",
  title:{
    text: "Instagram Audience Insights by Age and Gender"
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
    text: "Instagram Audience Insights by City"
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
    text: "Instagram Audience Insights by COUNTRY"
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


  // REACH CHART

var chartContainerReach = new CanvasJS.Chart("chartContainerReach", {
  animationEnabled: true,
  theme: "light2",
  title:{
    text: "Last 14 days Reach"
  },
  axisX: {
    valueFormatString: "DD MMM"
  },
  axisY: {
    title: "Total Number of Reach",
    includeZero: true,
    maximum: 200
  },
  data: [{
    type: "spline",
    color: "#6599FF",
    xValueType: "dateTime",
    xValueFormatString: "DD MMM",
    yValueFormatString: "#,##0 Reach",
    dataPoints: <?php echo json_encode($dataPointsReach1); ?>
  }]
});
chartContainerReach.render();
 

 //REACH 

}
</script>
<div class="w-100" id="gender_div">
<div class="mt-4 mx-auto" id="chartContainer" style="height: 370px; width: 100%;"></div>
</div>

<div class=" mx-auto" id="city_div">
<div class="mx-auto mt-4" id="chartContainerCity" style="height: 370px; width: 100%;"></div>
</div>

<div class=" " id="country_div">
<div class="mt-4" id="chartContainerCountry" style="height: 370px; width: 100%;"></div>
</div>

<div class="" id="reach_div">
<div class="mt-4" id="chartContainerReach" style="height: 370px; width: 100%;"></div>
</div>

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

<script type="text/javascript">
    if (window.location.hash && window.location.hash == '#_=_') {
        if (window.history && history.pushState) {
            window.history.pushState("", document.title, window.location.pathname);
        } else {
            // Prevent scrolling by storing the page's current scroll offset
            var scroll = {
                top: document.body.scrollTop,
                left: document.body.scrollLeft
            };
            window.location.hash = '';
            // Restore the scroll offset, should be flicker free
            document.body.scrollTop = scroll.top;
            document.body.scrollLeft = scroll.left;
        }
    }
</script>

          @endsection
        
       
