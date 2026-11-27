@extends('layouts.app')

@section('title','Manage Teachers')


@section('content')


<div class="container py-5">


<div class="card shadow border-0 rounded-4 overflow-hidden">


<div class="card-header bg-primary text-white 
d-flex justify-content-between align-items-center">


<h4 class="mb-0">
    👨‍🏫 Manage Teachers
</h4>



<a href="{{ route('admin.teachers.create') }}"
class="btn btn-light rounded-pill">

+ Add Teacher

</a>


</div>





<div class="card-body">



@if(session('success'))

<div class="alert alert-success rounded-3">

{{ session('success') }}

</div>

@endif






<div class="table-responsive">


<table class="table table-hover align-middle">



<thead class="table-dark">


<tr>

<th>#</th>

<th>Name</th>

<th>Email</th>

<th>Status</th>

<th width="220">
Action
</th>


</tr>


</thead>





<tbody>



@forelse($teachers as $teacher)



<tr>


<td>
{{ $loop->iteration }}
</td>





<td>

<div class="fw-bold">

{{ $teacher->name }}

</div>

</td>





<td>

{{ $teacher->email }}

</td>







<td>


@if($teacher->trashed())


<span class="badge bg-secondary rounded-pill">

Deleted

</span>



@elseif($teacher->status)



<span class="badge bg-success rounded-pill">

Active

</span>



@else



<span class="badge bg-danger rounded-pill">

Inactive

</span>



@endif



</td>








<td>



{{-- Activate / Deactivate --}}

@if(!$teacher->trashed())


<a href="{{ route('admin.teachers.status',$teacher->id) }}"
class="btn btn-warning btn-sm rounded-pill mb-1">


@if($teacher->status)

Deactivate

@else

Activate

@endif


</a>


@endif






{{-- Delete / Restore Button --}}


<form action="{{ route('admin.teachers.delete',$teacher->id) }}"
method="POST"
class="d-inline">


@csrf

@method('DELETE')




@if($teacher->trashed())


<button type="submit"
class="btn btn-success btn-sm rounded-pill"
onclick="return confirm('Restore this teacher?')">


Restore


</button>



@else


<button type="submit"
class="btn btn-danger btn-sm rounded-pill"
onclick="return confirm('Delete this teacher?')">


Delete


</button>



@endif



</form>





</td>



</tr>




@empty


<tr>

<td colspan="5"
class="text-center text-muted py-4">

No Teachers Found

</td>


</tr>


@endforelse




</tbody>


</table>


</div>

</div>


</div>


</div>


@endsection