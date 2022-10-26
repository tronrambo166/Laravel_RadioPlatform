@extends('layout') 
@section('page')


<?php $data= Session::get('data'); echo '<pre>'; print_r( $data['fans_by_gender']); echo '<pre>'; ?>
<div class=" mx-auto" style="width:95%; background:#161616;" >  
   <h4 class="text-center mt-2 text-light">Deezer Report <a href="{{route('deezer')}}" class="float-right text-light rounded-0 mr-2 px-4 btn btn-outline-dark font-weight-bold my-1">Back</a></h4> 
    <hr>
         <div class="row"> 
            

<div class="col-sm-7 chart1">
<?php
 
$dataPoints1 = array(
  array("label"=> "13-17", "y"=> 36.12),
  array("label"=> "18-24", "y"=> 34.87),
  array("label"=> "25-34", "y"=> 40.30),
  array("label"=> "35-44", "y"=> 35.30),
  array("label"=> "45-54", "y"=> 39.50),
  array("label"=> "55-65", "y"=> 50.82),
  array("label"=> "65+", "y"=> 74.70)
);
$dataPoints2 = array(
  array("label"=> "13-17", "y"=> 36.12),
  array("label"=> "18-24", "y"=> 34.87),
  array("label"=> "25-34", "y"=> 40.30),
  array("label"=> "35-44", "y"=> 35.30),
  array("label"=> "45-54", "y"=> 39.50),
  array("label"=> "55-65", "y"=> 50.82),
  array("label"=> "65+", "y"=> 74.70)
);
  
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2",
  title:{
    text: "Average Amount Spent on Real and Artificial X-Mas Trees in U.S."
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
    name: "Real Trees",
    indexLabel: "{y}",
    yValueFormatString: "$#0.##",
    showInLegend: true,
    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
  },{
    type: "column",
    name: "Artificial Trees",
    indexLabel: "{y}",
    yValueFormatString: "$#0.##",
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
 
}
</script>

<div id="chartContainer" style="height: 370px; width: 100%;"></div>



{{-- 2nd Chart 
<script type="text/javascript">
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  title:{
    text: "Olympic Medals of all Times (till 2016 Olympics)"
  },
  axisY: {
    title: "Medals",
    includeZero: true
  },
  legend: {
    cursor:"pointer",
    itemclick : toggleDataSeries
  },
  toolTip: {
    shared: true,
    content: toolTipFormatter
  },
  data: [{
    type: "bar",
    showInLegend: true,
    name: "Gold",
    color: "gold",
    dataPoints: [
      { y: 243, label: "Italy" },
      { y: 236, label: "China" },
      { y: 243, label: "France" },
      { y: 273, label: "Great Britain" },
      { y: 269, label: "Germany" },
      { y: 196, label: "Russia" },
      { y: 1118, label: "USA" }
    ]
  },
  {
    type: "bar",
    showInLegend: true,
    name: "Silver",
    color: "silver",
    dataPoints: [
      { y: 212, label: "Italy" },
      { y: 186, label: "China" },
      { y: 272, label: "France" },
      { y: 299, label: "Great Britain" },
      { y: 270, label: "Germany" },
      { y: 165, label: "Russia" },
      { y: 896, label: "USA" }
    ]
  },
  {
    type: "bar",
    showInLegend: true,
    name: "Bronze",
    color: "#A57164",
    dataPoints: [
      { y: 236, label: "Italy" },
      { y: 172, label: "China" },
      { y: 309, label: "France" },
      { y: 302, label: "Great Britain" },
      { y: 285, label: "Germany" },
      { y: 188, label: "Russia" },
      { y: 788, label: "USA" }
    ]
  }]
});
chart.render();

function toolTipFormatter(e) {
  var str = "";
  var total = 0 ;
  var str3;
  var str2 ;
  for (var i = 0; i < e.entries.length; i++){
    var str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\">" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
    total = e.entries[i].dataPoint.y + total;
    str = str.concat(str1);
  }
  str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
  str3 = "<span style = \"color:Tomato\">Total: </span><strong>" + total + "</strong><br/>";
  return (str2.concat(str)).concat(str3);
}

function toggleDataSeries(e) {
  if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  }
  else {
    e.dataSeries.visible = true;
  }
  chart.render();
}

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div> --}}


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
   
  </tbody>

</table>


</div>

         </div>  


  

<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>


        
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>





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
        
       

