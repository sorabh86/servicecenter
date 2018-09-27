<?php

/**
 * This is used to control customer specific actions & services
 */

class Customer extends Controller {

    public function index() {
        $this->view('layouts/header');
        $this->view('customer/index');
        $this->view('layouts/footer');
    }

    public function register() {
        $post = $_POST;
		if(isset($post['submit']) ) {
            $customerModel = $this->model('CustomerModel');
            
            if($customerModel->customer_exist($post['username'])) {
                $this->view("layouts/header");
                $this->view("customer/register", array(
                    "error"=>"Username already Exist, Please try again."
                ));
                $this->view("layouts/footer");
                exit(); 
            } else {
                if($customerModel->insert_customer($post)) {
                    $this->redirect('customer/login');
                } else {
                    $this->view("layouts/header");
                    $this->view("customer/register", array(
                        "error"=>"Database Error, Please try again."
                    ));
                    $this->view("layouts/footer");
                    exit();
                }
            }
        }
        
        $this->view("layouts/header");
        $this->view("customer/register");
        $this->view("layouts/footer");
    }

    public function login() {
        if(isset($_SESSION['user'])) {
            $this->redirect('customer');
            exit();
        }
        $post = $_POST;
		if(isset($post['submit'])) {
			$customerModel = $this->model('CustomerModel');
			if($user = $customerModel->authenticate($post)) {
				$_SESSION['user'] = $user;
                $this->redirect('customer');
                exit();
			} else {
                $this->view("layouts/header");
                $this->view("customer/login",array(
                    'error' => 'Invalid Username or Password'
                ));
                $this->view("layouts/footer");
                exit();
			}
		}

        $this->view("layouts/header");
        $this->view("customer/login");
        $this->view("layouts/footer");
    }

    public function logout() {
		unset($_SESSION['user']);
		
		$this->redirect('customer/login');
    }

    public function profile() {
        $this->view("layouts/header");
        $this->view("customer/profile");
        $this->view("layouts/footer");
    }
    public function editprofile() {
        $post = $_POST;
        if(isset($post['submit'])) {
            $customerModel = $this->model('CustomerModel');

        }

        $this->view("layouts/header");
        $this->view("customer/editprofile");
        $this->view("layouts/footer");
    }

    public function devices() {
        $this->view("layouts/header");
        $this->view("customer/devices");
        $this->view("layouts/footer");
    }
    public function adddevice() {
        $this->view("layouts/header");
        $this->view("customer/adddevice");
        $this->view("layouts/footer");
    }
    
    public function faultservice() {
        $this->view("layouts/header");
        $this->view("customer/faultservice");
        $this->view("layouts/footer");
    }
    public function addfault() {
        $this->view("layouts/header");
        $this->view("customer/addfault");
        $this->view("layouts/footer");
    }

    public function maintenance() {
        $this->view("layouts/header");
        $this->view("customer/maintenance");
        $this->view("layouts/footer");
    }
}