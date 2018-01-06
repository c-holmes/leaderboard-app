@extends('layouts.master')

@section('content')
<div class="game">
	<div class="game-container">
		<button id="startGame" onClick="startGame()">Start Game</button>
		<canvas id="myCanvas" width="735" height="500"></canvas>
	</div>
</div>
@endsection

@section('scripts')
<script src="/js/game.js"></script>
@endsection