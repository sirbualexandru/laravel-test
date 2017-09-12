<?php

namespace App\Http\Controllers;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if (Auth::check()) {		
			if (Auth::user()->hasRole('employer')) {
				return view('jobs.index', [
					'active_menu' => 'jobs',
				]);
			}

			if (Auth::user()->hasRole('candidate')) {
				return view('jobs.index', [
					'active_menu' => 'jobs',
				]);
			}

			return view('home', [
				'active_menu'	=> 'dashboard',
			]);
			
		} else {
			return view('auth.login') ;
		}
    }
}
