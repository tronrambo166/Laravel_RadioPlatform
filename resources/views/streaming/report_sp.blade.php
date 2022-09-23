@extends('layout') 
@section('page')



<div class=" mx-auto" style="width:95%; background:#161616;" >  
   <h4 class="text-center mt-2 text-light">Spotify Report</h4> <hr>
         <div class="row"> 
            

<div class="col-sm-7 chart1">
<?php
 $max=($views[5]['view']>10000000)?($views[5]['view']+$views[5]['view']):10000000; 
 $dataPoints = array(
  array( "y" => $views[0]['view'], "label" => $views[0]['date']),
  array( "y" => $views[1]['view'], "label" => $views[1]['date']),
  array( "y" => $views[2]['view'], "label" => $views[2]['date']),
  array( "y" => $views[3]['view'], "label" => $views[3]['date']),
  array( "y" => $views[4]['view'], "label" => $views[4]['date']),
  array( "y" => $views[5]['view'], "label" => $views[5]['date']),
  // array( "y" => $views[6]['view'], "label" => $views[6]['date']),
  // array( "y" => $views[7]['view'], "label" => $views[7]['date']),
  // array( "y" => $views[8]['view'], "label" => $views[8]['date']),
  // array( "y" => $views[9]['view'], "label" => $views[9]['date']),
  // array( "y" => $views[10]['view'], "label" => $views[10]['date']),
  // array( "y" => $views[11]['view'], "label" => $views[11]['date']),
  // array( "y" => $views[12]['view'], "label" => $views[12]['date']),
  // array( "y" => $views[13]['view'], "label" => $views[13]['date']),
  // array( "y" => $views[14]['view'], "label" => $views[14]['date']),
  // array( "y" => $views[15]['view'], "label" => $views[15]['date']),
  // array( "y" => $views[16]['view'], "label" => $views[16]['date']),
  // array( "y" => $views[17]['view'], "label" => $views[17]['date']),
  // array( "y" => $views[18]['view'], "label" => $views[18]['date']),
  // array( "y" => $views[19]['view'], "label" => $views[19]['date']),
  // array( "y" => $views[20]['view'], "label" => $views[20]['date']),
  // array( "y" => $views[21]['view'], "label" => $views[21]['date']),
  // array( "y" => $views[22]['view'], "label" => $views[22]['date']),
  // array( "y" => $views[23]['view'], "label" => $views[23]['date']),
  // array( "y" => $views[24]['view'], "label" => $views[24]['date']),
  // array( "y" => $views[25]['view'], "label" => $views[25]['date']),
  // array( "y" => $views[26]['view'], "label" => $views[26]['date']),
  // array( "y" => $views[27]['view'], "label" => $views[27]['date']),
  // array( "y" => $views[28]['view'], "label" => $views[28]['date']),
  // array( "y" => $views[29]['view'], "label" => $views[29]['date']),
  // array( "y" => $views[30]['view'], "label" => $views[30]['date'])
  
 );
 
?>

<script> 
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2",
  title:{
    text: "Monthly Gained Listeners for Nyashinski"
  },
  axisX: {
    valueFormatString: "DD MMM"
  },
  axisY: {
    title: "Total Number of Listeners",
    includeZero: true,
    maximum: <?php echo $max; ?>
  },
  data: [{
    type: "spline",
    color: "#6599FF",
    xValueType: "dateTime",
    xValueFormatString: "DD MMM",
    yValueFormatString: "#,##0 Listeners",
    dataPoints: <?php echo json_encode($dataPoints); ?>
  }]
});
 

 



chart.render();
}
</script>


<div id="chartContainer" style="height: 320px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</div>


        
 <div class="col-sm-5 chart2">

<table class="table tabil mb-4 text-white">
  <thead>
    <tr>
      <th scope="col">Date</th>
      
      <th scope="col">Listeners</th>
       <th scope="col">Earnings</th>    
    
    </tr>
  </thead>

  <tbody class="bg-light text-dark" id="songs">  
   @for($i=0;$i<=5;$i++)
    <tr id="loading">
       <td scope="row" class="text-center"> {{$views[$i]['date']}} </td>
      
      <td scope="row" class="text-center"> {{$views[$i]['view']}} </td>
      <td scope="row" class="text-center">  ${{ round(0.0033*$views[$i]['view']) }}</td>
               
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
        
       

