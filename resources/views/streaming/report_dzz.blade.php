@extends('layout') 
@section('page')



<div class=" mx-auto" style="width:95%; background:#161616;" >  
   <h4 class="text-center mt-2 text-light">Deezer Report <a href="{{route('deezer')}}" class="float-right text-light rounded-0 mr-2 px-4 btn btn-outline-dark font-weight-bold my-1">Back</a></h4> 
    <hr>
         <div class="row"> 
            

<div class="col-sm-7 chart1">
<?php
 $max=($views[1]['view']>20000)?($views[1]['view']+$views[1]['view']):20000; 
 $dataPoints = array(
   array( "y" => $views[60]['view'], "label" => $views[60]['date']),
  array( "y" => $views[61]['view'], "label" => $views[61]['date']),
  array( "y" => $views[62]['view'], "label" => $views[62]['date']),
  array( "y" => $views[63]['view'], "label" => $views[63]['date']),
  array( "y" => $views[64]['view'], "label" => $views[64]['date']),
  array( "y" => $views[65]['view'], "label" => $views[65]['date']),
  array( "y" => $views[66]['view'], "label" => $views[66]['date']),
  array( "y" => $views[67]['view'], "label" => $views[67]['date']),
  array( "y" => $views[68]['view'], "label" => $views[68]['date']),
  array( "y" => $views[69]['view'], "label" => $views[69]['date']),
  array( "y" => $views[70]['view'], "label" => $views[70]['date']),
  array( "y" => $views[71]['view'], "label" => $views[71]['date']),
  array( "y" => $views[72]['view'], "label" => $views[72]['date']),
  array( "y" => $views[73]['view'], "label" => $views[73]['date']),
  array( "y" => $views[74]['view'], "label" => $views[74]['date']),
  array( "y" => $views[75]['view'], "label" => $views[75]['date']),
  array( "y" => $views[76]['view'], "label" => $views[76]['date']),
  array( "y" => $views[77]['view'], "label" => $views[77]['date']),
  array( "y" => $views[78]['view'], "label" => $views[78]['date']),
  array( "y" => $views[79]['view'], "label" => $views[79]['date']),
  array( "y" => $views[80]['view'], "label" => $views[80]['date']),
  array( "y" => $views[81]['view'], "label" => $views[81]['date']),
  array( "y" => $views[82]['view'], "label" => $views[82]['date']),
  array( "y" => $views[83]['view'], "label" => $views[83]['date']),
  array( "y" => $views[84]['view'], "label" => $views[84]['date']),
  array( "y" => $views[85]['view'], "label" => $views[85]['date']),
  array( "y" => $views[86]['view'], "label" => $views[86]['date']),
  array( "y" => $views[87]['view'], "label" => $views[87]['date']),
  array( "y" => $views[88]['view'], "label" => $views[88]['date']),
  array( "y" => $views[89]['view'], "label" => $views[89]['date']),
  array( "y" => $views[90]['view'], "label" => $views[90]['date'])
 );
 
?>

<script> 
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2",
  title:{
    text: "Monthly Gained Fans for Nyashinski"
  },
  axisX: {
    valueFormatString: "DD MMM"
  },
  axisY: {
    title: "Total Number of Fans",
    includeZero: true,
    maximum: <?php echo $max; ?>
  },
  data: [{
    type: "spline",
    color: "#6599FF",
    xValueType: "dateTime",
    xValueFormatString: "DD MMM",
    yValueFormatString: "#,##0 Fans",
    dataPoints: <?php echo json_encode($dataPoints); ?>
  }]
});
 

 



chart.render();
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
      
      <th scope="col">Fans</th>
       
    
    </tr>
  </thead>

  <tbody class="bg-light text-dark" id="songs">  
   @for($i=60;$i<=90;$i++)
    <tr id="loading">
       <td scope="row" class="text-center"> {{$views[$i]['date']}} </td>
     
      <td scope="row" class="text-center"> {{$subs_real[$i]['view']}} </td>
      
               
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
        
       

