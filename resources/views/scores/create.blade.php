<form method="POST" action="/scores">
	{{ csrf_field() }}
	<div class="form-group">
		<label for="name">Score:</label>
		<input type="number" class="form-control" name="score" required>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</form>
