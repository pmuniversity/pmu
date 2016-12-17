<?php

namespace PMU\Http\Controllers\Admin;

use Illuminate\Http\Request;
use PMU\Http\Controllers\Controller;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware ( 'auth' );
	}
	
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view ( 'admin.home', [ 
				'pageTitle' => 'Dashboard' 
		] );
	}
}
