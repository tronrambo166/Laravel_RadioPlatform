@extends('layout') 
@section('page')



<div class=" mx-auto" style="width:95%; background:#161616;" >  
   <h4 class="text-center mt-2 text-light w-75">Youtube Report <a href="{{route('youtube')}}" class="float-right text-light rounded-0 mr-2 px-4 btn btn-outline-dark font-weight-bold my-1">Back</a>
   </h4> <hr>
   

         <div class="row"> 
            

<div class="col-sm-7 chart1">
<?php

 $dataPoints = array(
  
  
 );



 $dataPoints2 = array(
  
  
  
 );
 
 
?>

<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2",
  title:{
    text: "Monthly Gained Video Views for Nyashinski"
  },
  axisX: {
    valueFormatString: "DD MMM"
  },
  axisY: {
    title: "Total Number of Views",
    includeZero: true,
    maximum: 10000000
  },
  data: [{
    type: "spline",
    color: "#6599FF",
    xValueType: "dateTime",
    xValueFormatString: "DD MMM",
    yValueFormatString: "#,##0 Visits",
    dataPoints: <?php echo json_encode($dataPoints); ?>
  }]
});
 

 


//_______________________________________________________________________//

var chart2 = new CanvasJS.Chart("chartContainer2", {
  animationEnabled: true,
  theme: "light2",
  title:{
    text: "Monthly Gained Subscribers for Nyashinski"
  },
  axisX: {
    valueFormatString: "DD MMM"
  },
  axisY: {
    title: "Total Number of Subscribers",
    includeZero: true,
    maximum: 500000
  },
  data: [{
    markerSize:7,
    type: "spline",
    color: "#6599FF",
    xValueType: "dateTime",
    xValueFormatString: "DD MMM",
    yValueFormatString: "#,##0 Subscribers",
    dataPoints: <?php echo json_encode($dataPoints2); ?>
  }]
});
chart.render();
chart2.render();
}
</script>


<div id="chartContainer" style="height: 320px; width: 100%;"></div>
<div id="chartContainer2" class="mt-2" style="height: 320px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</div>


        
 <div class="col-sm-5 chart2">

<table class="table tabil mb-4 text-white">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Subscribers</th>
      <th scope="col">Video Views</th>
       <th scope="col">Earnings</th>    
    
    </tr>
  </thead>

  <tbody class="bg-light text-dark" id="songs">  
   @for($i=0;$i<=30;$i++)
    <tr id="loading">
       <td scope="row" class="text-center"> {{$data['followers']}} </td>
      <td scope="row" class="text-center"> {{$data['followers']}} </td>
      <td scope="row" class="text-center"> {{$data['followers']}} </td>
     
               
    </tr>
    @endfor
  </tbody>

</table>


</div>

         </div>  


  

<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>


        
</div>



          @endsection
        
       

