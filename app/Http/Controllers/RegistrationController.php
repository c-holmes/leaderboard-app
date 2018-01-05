<?php

namespace App\Http\Controllers;

use App\User;

class RegistrationController extends Controller
{
	public function create()
	{
		return view('registration.create');
	}

	public function store()
	{
		//validate form data
		$this->validate(request(), [
			'name' => 'required',
			'email' => 'required|email',
			'password' => 'required|confirmed',
			'nickname' => 'required',
			'country' => 'required'
		]);

		//create user
		$user = User::create([
			'name' => request('name'),
			'email' => request('email'),
			'password' => bcrypt(request('password')),
			'nickname' => request('nickname'),
			'country' => request('country')
		]);

		//sign user in
		auth()->login($user);

		//redirect
		return redirect()->home();
	}
}
