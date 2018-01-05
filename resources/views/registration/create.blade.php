@extends('layouts.master')

@section('content')

<h1>Register</h1>
<form method="POST" action="/register">
	{{ csrf_field() }}
	<div class="form-group">
		<label for="name">Name:</label>
		<input type="text" class="form-control" name="name" required>
	</div>
	<div class="form-group">
		<label for="email">Email:</label>
		<input type="email" class="form-control" name="email" required>
	</div>
	<div class="form-group">
		<label for="nickname">Nickname:</label>
		<input type="text" class="form-control" name="nickname" required>
	</div>
	<div class="form-group">
		<label for="name">Country:</label>
		<input type="text" class="form-control" name="country" required>
	</div>
	<div class="form-group">
		<label for="password">Password:</label>
		<input type="password" class="form-control" name="password" required>
	</div>
	<div class="form-group">
		<label for="password_confirmation">Password Confirmation:</label>
		<input type="password" class="form-control" name="password_confirmation" required>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
	@include ('partials.errors')
</form>

@endsection