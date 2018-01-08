<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<a class="navbar-brand" href="/">Breakout</a>

	<div class="collapse navbar-collapse" id="navbarsExampleDefault">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="/">Play <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="/highscores" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Highscores</a>
				<div class="dropdown-menu" aria-labelledby="dropdown01">
					<a class="dropdown-item" href="/highscores?date=daily">Today</a>
					<a class="dropdown-item" href="/highscores?date=weekly">This Week</a>
					<a class="dropdown-item" href="/highscores?date=monthly">This Month</a>
					<a class="dropdown-item" href="/highscores?date=yearly">This Year</a>
					<a class="dropdown-item" href="/highscores">All Time</a>
				</div>
			</li>
		</ul>
		<ul class="navbar-nav">
			@if (Auth::check())
				<li class="nav-item">
					<a class="nav-link">Hello {{Auth::user()->name}}</a>
				</li>
				<li class="nav-item"><a class="nav-link">|</a></li>
				<li class="nav-item">
					<a class="nav-link" href="/logout">Logout</a>
				</li>
			@else
				<li class="nav-item">
					<a class="nav-link" href="/login">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/register">Register</a>
				</li>
			@endif
		</ul>
	</div>
</nav>