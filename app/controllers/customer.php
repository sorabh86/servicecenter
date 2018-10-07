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
                unset($_SESSION['user']->password);
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
        if(isset($_POST['submit'])) {
            $customerModel = $this->model('CustomerModel');
            $stat = $customerModel->update_customer($_POST);
            if($stat->error) die('Error: '.$stat->message.'. <a href="'.SC_URL.'customer/editprofile">goback</a>');

            $user = $_SESSION['user'];
            $user->name = $_POST['name'];
            $user->address = $_POST['address'];
            $user->phone = $_POST['phone'];
            $this->redirect('customer/profile');
        }

        $this->view("layouts/header");
        $this->view("customer/editprofile");
        $this->view("layouts/footer");
    }
    public function changepassword() {
        if(isset($_POST['submit'])) {
            $customerModel = $this->model('CustomerModel');
            $stat = $customerModel->change_password($_POST);
            if($stat->error) die('Error: '.$stat->message.'. <a href="'.SC_URL.'customer/editprofile">goback</a>');

            $this->redirect('customer/logout');
        }
        
        $this->view("layouts/header");
        $this->view("customer/changepassword");
        $this->view("layouts/footer");
    }

    /**
     * Manage customer devices
     */
    public function devices() {
        $customer_id = $_SESSION['user']->id;
        $devModel = $this->model('DeviceModel');
        $devices = $devModel->get_by_customer_id($customer_id);

        $this->view("layouts/header");
        $this->view("customer/devices",array(
            'devices' => $devices
        ));
        $this->view("layouts/footer");
    }
    public function adddevice() {
        if(isset($_POST['submit'])) {
            $devModel = $this->model('DeviceModel');
            $devModel->insert_device($_POST);
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

        $devModel = $this->model('DeviceModel');
        $device = $devModel->get_by_id($_GET['id']); 

        if(isset($_POST['submit'])) {
            $status = $devModel->update_device($_POST);
            $this->redirect('customer/devices');
            exit();
        }

        $customer_id = $_SESSION['user']->id;
        $catModel = $this->model('CategoryModel');
        $categories = $catModel->get_categories();

        $this->view("layouts/header");
        $this->view("customer/editdevice", array(
            'device' => $device,
            'customer_id' => $customer_id,
            'categories' => $categories
        ));
        $this->view("layouts/footer");
    }
    
    /**
     * Manage customer fault Service Request
     */
    public function faultservice() {
        if(!isset($_SESSION['user']))
            $this->redirect('customer/login');
        
        $serviceModel = $this->model('ServiceModel');
        $services = $serviceModel->get_by_customer_id('fault_repair',$_SESSION['user']->id);
        
        $this->view("layouts/header");
        $this->view("customer/faultservice",array(
            'services' => $services
        ));
        $this->view("layouts/footer");
    }
    public function addfault() {
        if(isset($_POST['submit'])) {
            $serviceModel = $this->model('ServiceModel');
            $status = $serviceModel->request_service($_POST);
            // echo $status->message;
            $this->redirect('customer/faultservice');
        }

        $devModel = $this->model('DeviceModel');
        $devices = $devModel->get_by_customer_id($_SESSION['user']->id);

        $this->view("layouts/header");
        $this->view("customer/addfault",array(
            'devices' => $devices
        ));
        $this->view("layouts/footer");
    }

    /**
     * Manage customer maintenance services
     */
    public function maintenance() {
        if(!isset($_SESSION['user']))
            $this->redirect('customer/login');
        
        $serviceModel = $this->model('ServiceModel');
        $services = $serviceModel->get_by_customer_id('maintenance', $_SESSION['user']->id);

        $this->view("layouts/header");
        $this->view("customer/maintenance", array(
            'services' => $services
        ));
        $this->view("layouts/footer");
    }

    public function addmaintenance() {
        if(isset($_POST['submit'])) {
            $serviceModel = $this->model('ServiceModel');
            $status = $serviceModel->request_service($_POST);
            // echo $status->message;
            $this->redirect('customer/maintenance');
        }
        $devModel = $this->model('DeviceModel');
        $devices = $devModel->get_by_customer_id($_SESSION['user']->id);

        $this->view("layouts/header");
        $this->view("customer/addmaintenance", array(
            'devices' => $devices
        ));
        $this->view("layouts/footer");
    }
}