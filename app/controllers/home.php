<?php 

/**
* This module is controlling Static Pages on Website
*/
class Home extends Controller {
	
	public function index() {
		$this->view('layouts/header');
		$this->view('home/index');
		$this->view('layouts/footer-1');
		$this->view('layouts/footer');
	}

	public function about() {
		$this->view('layouts/header');
		$this->view('home/about');
		$this->view('layouts/footer-1');
		$this->view('layouts/footer');
	}

	public function contact() {


		$this->view('layouts/header');
		$this->view('home/contact');
		$this->view('layouts/footer-1');
		$this->view('layouts/footer');
	}
}