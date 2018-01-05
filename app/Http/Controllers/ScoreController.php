<?php

namespace App\Http\Controllers;

use App\Score;

class ScoreController extends Controller
{
	public function __contruct()
	{
		$this->middleware('auth')->except('show');
	}

    public function show()
    {
        $scores = Score::orderBy('score', 'desc')->get();

    	return view('scores.index', compact('scores'));
    }

    public function store()
    {
    	// validate request
    	$this->validate(request(), [
    		'score' => 'integer|min:0'
    	]);

    	// create new score
        auth()->user()->publish(
            new Score(request(['score']))
        );

        // redirect
        return redirect()->home();
    }
}
