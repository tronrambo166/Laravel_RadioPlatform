@extends('layout') 
@section('page')



<div class="row mx-auto" style="width:90%; background:#161616;" >  
         <div class="col-md-12"> 
             <h4 class="text-center mt-2 text-light">Youtube Report</h4> <hr>

<div class="chart1">
<div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
     'January',
    'February',
    'March',
    'April',
    'May',
    'June'
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'My First dataset',
      backgroundColor: 'rgb(255, 255, 255)',
      borderColor: 'rgb(255, 99, 132)',
      data: [0, 10, 5, 2, 20, 30, 45,0, 10, 5, 2, 20, 30, 45,0, 10, 5, 2, 20, 30, 45],
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {}
  };

  const decimation = {
  enabled: false,
  algorithm: 'min-max',
};

 const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );


</script>

        


         </div>  


  

<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>
<div style="width:90%; background:#161616;" class=" mx-auto py-5"></div>


        
</div>



          @endsection
        
       

