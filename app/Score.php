<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Score extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	    'score'
	];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public static function highscores()
    {
    	switch(request('date')){
    		case('daily'):
    			return static::orderBy('score', 'desc')
    				->whereDay('created_at', Carbon::now()->day)
    				->get();
    			break;
    		case('weekly'):
    			return static::orderBy('score', 'desc')
    				->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
    				->get();
    			break;
    		case('monthly'):
    			return static::orderBy('score', 'desc')
    				->whereMonth('created_at', Carbon::now()->month)
    				->get();
    			break;
    		case('yearly'):
    			return static::orderBy('score', 'desc')
    				->whereYear('created_at', Carbon::now()->year)
    				->get();
    			break;
    		default:
    			return static::orderBy('score', 'desc')->get();
    	}
    }
}
