@extends('layout') 
@section('page')



<div class=" mx-auto" style="width:95%; background:#161616;" >  
   <h4 class="text-center mt-2 text-light">Youtube Report <a href="{{route('apple')}}" class="float-right text-light rounded-0 mr-2 px-4 btn btn-outline-dark font-weight-bold my-1">Back</a> </h4>
   <hr>
         <div class="row"> 
            

<div class="col-sm-7 chart1">
<?php

 $dataPoints = array(
  array( "y" => $views[0]['view'], "label" => $views[0]['date']),
  array( "y" => $views[1]['view'], "label" => $views[1]['date']),
  array( "y" => $views[2]['view'], "label" => $views[2]['date']),
  array( "y" => $views[3]['view'], "label" => $views[3]['date']),
  array( "y" => $views[4]['view'], "label" => $views[4]['date']),
  array( "y" => $views[5]['view'], "label" => $views[5]['date']),
  array( "y" => $views[6]['view'], "label" => $views[6]['date']),
  array( "y" => $views[7]['view'], "label" => $views[7]['date']),
  array( "y" => $views[8]['view'], "label" => $views[8]['date']),
  array( "y" => $views[9]['view'], "label" => $views[9]['date']),
  array( "y" => $views[10]['view'], "label" => $views[10]['date']),
  array( "y" => $views[11]['view'], "label" => $views[11]['date']),
  array( "y" => $views[12]['view'], "label" => $views[12]['date']),
  array( "y" => $views[13]['view'], "label" => $views[13]['date']),
  array( "y" => $views[14]['view'], "label" => $views[14]['date']),
  array( "y" => $views[15]['view'], "label" => $views[15]['date']),
  array( "y" => $views[16]['view'], "label" => $views[16]['date']),
  array( "y" => $views[17]['view'], "label" => $views[17]['date']),
  array( "y" => $views[18]['view'], "label" => $views[18]['date']),
  array( "y" => $views[19]['view'], "label" => $views[19]['date']),
  array( "y" => $views[20]['view'], "label" => $views[20]['date']),
  array( "y" => $views[21]['view'], "label" => $views[21]['date']),
  array( "y" => $views[22]['view'], "label" => $views[22]['date']),
  array( "y" => $views[23]['view'], "label" => $views[23]['date']),
  array( "y" => $views[24]['view'], "label" => $views[24]['date']),
  array( "y" => $views[25]['view'], "label" => $views[25]['date']),
  array( "y" => $views[26]['view'], "label" => $views[26]['date']),
  array( "y" => $views[27]['view'], "label" => $views[27]['date']),
  array( "y" => $views[28]['view'], "label" => $views[28]['date']),
  array( "y" => $views[29]['view'], "label" => $views[29]['date']),
  array( "y" => $views[30]['view'], "label" => $views[30]['date'])
  
 );



 $dataPoints2 = array(
  //array( "y" => $subs[0]['view'], "label" => $subs[0]['date']),
  // array( "y" => $subs[31]['view'], "label" => $subs[31]['date']),
  // array( "y" => $subs[32]['view'], "label" => $subs[32]['date']),
  // array( "y" => $subs[33]['view'], "label" => $subs[33]['date']),
  // array( "y" => $subs[34]['view'], "label" => $subs[34]['date']),
  // array( "y" => $subs[35]['view'], "label" => $subs[35]['date']),
  // array( "y" => $subs[36]['view'], "label" => $subs[36]['date']),
  // array( "y" => $subs[37]['view'], "label" => $subs[37]['date']),
  // array( "y" => $subs[38]['view'], "label" => $subs[38]['date']),
  // array( "y" => $subs[39]['view'], "label" => $subs[39]['date']),
  // array( "y" => $subs[40]['view'], "label" => $subs[40]['date']),
  array( "y" => $subs[41]['view'], "label" => $subs[41]['date']),
  array( "y" => $subs[42]['view'], "label" => $subs[42]['date']),
  array( "y" => $subs[43]['view'], "label" => $subs[43]['date']),
  array( "y" => $subs[44]['view'], "label" => $subs[44]['date']),
  array( "y" => $subs[45]['view'], "label" => $subs[45]['date']),
  array( "y" => $subs[46]['view'], "label" => $subs[46]['date']),
  array( "y" => $subs[47]['view'], "label" => $subs[47]['date']),
  array( "y" => $subs[48]['view'], "label" => $subs[48]['date']),
  array( "y" => $subs[49]['view'], "label" => $subs[49]['date']),
  array( "y" => $subs[50]['view'], "label" => $subs[50]['date']),
  array( "y" => $subs[51]['view'], "label" => $subs[51]['date']),
  array( "y" => $subs[52]['view'], "label" => $subs[52]['date']),
  array( "y" => $subs[53]['view'], "label" => $subs[53]['date']),
  array( "y" => $subs[54]['view'], "label" => $subs[54]['date']),
  array( "y" => $subs[55]['view'], "label" => $subs[55]['date']),
  array( "y" => $subs[56]['view'], "label" => $subs[56]['date']),
  array( "y" => $subs[57]['view'], "label" => $subs[57]['date']),
  array( "y" => $subs[58]['view'], "label" => $subs[58]['date']),
  array( "y" => $subs[59]['view'], "label" => $subs[59]['date']),
  array( "y" => $subs[60]['view'], "label" => $subs[60]['date']),
  array( "y" => $subs[61]['view'], "label" => $subs[61]['date']),
  array( "y" => $subs[62]['view'], "label" => $subs[62]['date']),
  array( "y" => $subs[63]['view'], "label" => $subs[63]['date']),
  array( "y" => $subs[64]['view'], "label" => $subs[64]['date']),
  array( "y" => $subs[65]['view'], "label" => $subs[65]['date']),
  array( "y" => $subs[66]['view'], "label" => $subs[66]['date']),
  array( "y" => $subs[67]['view'], "label" => $subs[67]['date']),
  array( "y" => $subs[68]['view'], "label" => $subs[68]['date']),
  array( "y" => $subs[69]['view'], "label" => $subs[69]['date']),
  array( "y" => $subs[70]['view'], "label" => $subs[70]['date']),
  array( "y" => $subs[71]['view'], "label" => $subs[71]['date']),
  array( "y" => $subs[72]['view'], "label" => $subs[72]['date']),
  array( "y" => $subs[73]['view'], "label" => $subs[73]['date']),
  array( "y" => $subs[74]['view'], "label" => $subs[74]['date']),
  array( "y" => $subs[75]['view'], "label" => $subs[75]['date']),
  array( "y" => $subs[76]['view'], "label" => $subs[76]['date']),
  array( "y" => $subs[77]['view'], "label" => $subs[77]['date']),
  array( "y" => $subs[78]['view'], "label" => $subs[78]['date']),
  array( "y" => $subs[79]['view'], "label" => $subs[79]['date']),
  array( "y" => $subs[80]['view'], "label" => $subs[80]['date']),
  array( "y" => $subs[81]['view'], "label" => $subs[81]['date']),
  array( "y" => $subs[82]['view'], "label" => $subs[82]['date']),
  array( "y" => $subs[83]['view'], "label" => $subs[83]['date']),
  array( "y" => $subs[84]['view'], "label" => $subs[84]['date']),
  array( "y" => $subs[85]['view'], "label" => $subs[85]['date']),
  array( "y" => $subs[86]['view'], "label" => $subs[86]['date']),
  array( "y" => $subs[87]['view'], "label" => $subs[87]['date']),
  array( "y" => $subs[88]['view'], "label" => $subs[88]['date']),
  array( "y" => $subs[89]['view'], "label" => $subs[89]['date'])
  
  
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
       <td scope="row" class="text-center"> {{$views[$i]['date']}} </td>
      <td scope="row" class="text-center"> {{$subs_real[$i+60]['view']}} </td>
      <td scope="row" class="text-center"> {{$views[$i]['view']}} </td>
      <td scope="row" class="text-center">  ${{ round(0.00067*$views[$i]['view']) }}</td>
               
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
        
       

