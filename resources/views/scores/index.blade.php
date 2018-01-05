@extends ('layouts.master')

@section('content')
<h2>Highscores</h2>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Rank</th>
				<th>Player</th>
				<th>Country</th>
				<th>Name</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($scores as $score)
				<tr>
					<td>{{ $score->score }}</td>
					<td>{{ $score->user->nickname }}</td>
					<td>{{ $score->user->country }}</td>
					<td>{{ $score->user->name }}</td>
					<td>{{ $score->created_at }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection