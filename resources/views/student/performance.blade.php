@extends('layouts.app')

@section('title','My Performance')

@section('content')

<div class="container py-5">


<div class="card shadow border-0 rounded-4">


<div class="card-header bg-primary text-white">

<h4>
📊 My Subject Performance
</h4>

</div>


<div class="card-body">

<canvas id="performanceChart"></canvas>

</div>


</div>


</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>


new Chart(
document.getElementById('performanceChart'),
{

type:'bar',

data:{


labels:@json($subjects),


datasets:[{

label:'Score Percentage',

data:@json($marks),

borderRadius:10


}]


},


options:{

responsive:true,


scales:{


y:{


beginAtZero:true,

max:100


}


}


}


});


</script>
@endsection