@extends('layouts.app')

@section('content')

<div class="container py-5">


<div class="card shadow border-0 rounded-4">


<div class="card-header bg-primary text-white">

<h4>
👨‍🏫 Add New Teacher
</h4>

</div>


<div class="card-body">


<form method="POST" 
action="{{ route('admin.teachers.store') }}">

@csrf


<div class="mb-3">

<label class="form-label">
Teacher Name
</label>

<input type="text"
name="name"
class="form-control"
placeholder="Enter teacher name">

</div>



<div class="mb-3">

<label class="form-label">
Email Address
</label>

<input type="email"
name="email"
class="form-control"
placeholder="Enter email">

</div>



<div class="mb-3">

<label class="form-label">
Password
</label>

<input type="password"
name="password"
class="form-control"
placeholder="Create password">

</div>



<button class="btn btn-success px-4">

Save Teacher

</button>


<a href="{{route('admin.teachers')}}"
class="btn btn-secondary">

Back

</a>


</form>


</div>


</div>


</div>


@endsection