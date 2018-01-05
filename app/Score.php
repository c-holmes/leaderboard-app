<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
