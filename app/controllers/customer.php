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

    /**
     * Manage customer devices
     */
    public function devices() {
        $customer_id = $_SESSION['user']->id;
        $prodModel = $this->model('ProductModel');
        $products = $prodModel->get_by_customer_id($customer_id);

        $this->view("layouts/header");
        $this->view("customer/devices",array(
            'products' => $products
        ));
        $this->view("layouts/footer");
    }
    public function adddevice() {
        if(isset($_POST['submit'])) {
            $prodModel = $this->model('ProductModel');
            $prodModel->insert_product($_POST);
            $this->redirect('customer/devices');
            exit();
        }

        $customer_id = $_SESSION['user']->id;
        $catModel = $this->model('CategoryModel');
        $categories = $catModel->get_categories();

        $this->view("layouts/header");
        $this->view("customer/adddevice", array(
            'customer_id' => $customer_id,
            'categories' => $categories
        ));
        $this->view("layouts/footer");
    }
    public function editdevice() {
        if(!isset($_GET['id']))
            $this->redirect('customer/devices');

        $prodModel = $this->model('ProductModel');
        $product = $prodModel->get_by_id($_GET['id']); 

        if(isset($_POST['submit'])) {
            $status = $prodModel->update_product($_POST);
            $this->redirect('customer/devices');
            exit();
        }

        $customer_id = $_SESSION['user']->id;
        $catModel = $this->model('CategoryModel');
        $categories = $catModel->get_categories();

        $this->view("layouts/header");
        $this->view("customer/editdevice", array(
            'product' => $product,
            'customer_id' => $customer_id,
            'categories' => $categories
        ));
        $this->view("layouts/footer");
    }
    
    /**
     * Manage customer fault Service Request
     */
    public function faultservice() {
        $faultModel = $this->model('FaultModel');
        $faults = $faultModel->get_faults();

        $this->view("layouts/header");
        $this->view("customer/faultservice",array(
            'faults' => $faults
        ));
        $this->view("layouts/footer");
    }
    public function addfault() {
        if(isset($_POST['submit'])) {
            $faultModel = $this->model('FaultModel');
            $status = $faultModel->request_fault($_POST);
            echo $status->message;
            exit();
        }

        $prodModel = $this->model('ProductModel');
        $products = $prodModel->get_products();

        $this->view("layouts/header");
        $this->view("customer/addfault",array(
            'products' => $products
        ));
        $this->view("layouts/footer");
    }

    /**
     * Manage customer maintenance services
     */
    public function maintenance() {
        $this->view("layouts/header");
        $this->view("customer/maintenance");
        $this->view("layouts/footer");
    }
}