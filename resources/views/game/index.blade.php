@extends('layouts.master')

@section('content')
<div class="game-container">
	<canvas id="myCanvas" width="480" height="320"></canvas>

  	@include('scores.create')
</div>
@endsection

@section('scripts')
<script src="/js/game.js"></script>
@endsection