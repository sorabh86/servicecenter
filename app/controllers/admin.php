<?php

/**
 * Your All admin Modules will be handled by this controller
 */

class Admin extends Controller {
    
    public function index () {
        $this->checklogin();
        $this->managecategory();
    }

    private function checklogin() {
        if(!isset($_SESSION['admin'])) {
            $this->redirect('admin/login');
            exit();
        }
    }
    
    public function login () {
        if(isset($_SESSION['admin']))
            $this->redirect('admin/index');

        if(isset($_POST['username']) && isset($_POST['password'])) {
            $admin = $this->model('AdminModel');
            
            if($_POST['username'] == $admin->username && $_POST['password'] == $admin->password) {
                $_SESSION['admin'] = [
                    'name' => $admin->name,
                    'post' => $admin->post
                ];
                $this->redirect('admin');
                exit();
            } else {
                $this->view('admin/layout/header');
                $this->view('admin/login', array(
                    'error' => "Invalid Username or Password."
                ));
                $this->view('admin/layout/footer');
                exit();
            }
        }

        $this->view('admin/layout/header');
        $this->view('admin/login');
        $this->view('admin/layout/footer');
    }
    public function logout (){
        if(isset($_SESSION['admin']))
            unset($_SESSION['admin']);

        $this->redirect([
            "url" => 'admin/login',
            "title" => "Success",
            "message" => "You are Logged out"
        ]);
    }

    /**
     * Manage Category of devices that organization repairs
     */
    public function managecategory() {
        $catModel = $this->model('CategoryModel');

        if(isset($_POST['submit'])) {
            $name = $_POST['name'];
            if($name != '') {
                $catModel->insert_category($name);
            }
        }
       
        $cat = $catModel->get_categories();

        $this->view('admin/layout/header');
        $this->view('admin/layout/sidelink', array(
            "mcat" => true
        ));
        $this->view('admin/managecategory', array(
            'cat' => $cat
        ));
        $this->view('admin/layout/footer');
    }
    public function addcategory() {
        
        // $this->redirect('admin/managecategory');
        exit();
    }
    public function deletecategory() {
        if(isset($_GET['id'])) {
            $catModel = $this->model('CategoryModel');
            $catModel->delete_by_id($_GET['id']);
        }
        $this->redirect('admin/managecategory');
        exit();
    }

    /**
     * Manage devices or device added by customer or added by admin
     */
    public function managedevice() {
        $prodModel = $this->model('DeviceModel');
        $devices = $prodModel->get_devices();

        $this->view('admin/layout/header');
        $this->view('admin/layout/sidelink', array(
            "mdevice" => true
        ));
        $this->view('admin/managedevice', array(
            'devices' => $devices
        ));
        $this->view('admin/layout/footer');
    }
    public function adddevice() {
        $post = $_POST;
        if(isset($post['submit'])) {
            $prodModel = $this->model('DeviceModel');

            $status =$prodModel->insert_device($post); 
            if($status->error) {
                echo '<br> fail'.$status->message;
            } else {
                echo '<br> success';
                $this->redirect('admin/managedevice');
                exit();
            }
        }

        $catModel = $this->model('CategoryModel');
        $categories = $catModel->get_categories();
        $custModel = $this->model('CustomerModel');
        $customers = $custModel->get_customers();

        $this->view('admin/layout/header');
        $this->view('admin/adddevice', array(
            'customers' => $customers,
            'cat' => $categories
        ));
        $this->view('admin/layout/footer');
    }
    public function editdevice() {
        if(!isset($_GET['id']))
            $this->redirect('admin/managedevice');

        $prodModel = $this->model('DeviceModel');
        $device = $prodModel->get_by_id($_GET['id']);
        
        if(isset($_POST['submit'])) {
            $status = $prodModel->update_device($_POST);
            if($status->error) {
                echo '<br> fail:'.$status->message;
            } else {
                echo "<br> success";
                $this->redirect('admin/managedevice');
                exit();
            }
        }

        $catModel = $this->model('CategoryModel');
        $categories = $catModel->get_categories();
        $custModel = $this->model('CustomerModel');
        $customers = $custModel->get_customers();

        $this->view('admin/layout/header');
        $this->view('admin/editdevice', array(
            'customers' => $customers,
            'cat' => $categories,
            'device' => $device
        ));
        $this->view('admin/layout/footer');
    }
    public function deletedevice() {
        if(!isset($_GET['id']))
            $this->redirect('admin/managedevice');
        
        $prodModel = $this->model('DeviceModel');
        $status = $prodModel->delete_by_id($_GET['id']);
        if($status->error) {
            echo '<br> fail:'.$status->message;
        } else {
            echo "<br> success";
            $this->redirect('admin/managedevice');
            exit();
        }
    }
    
    /**
     * Manage customers
     */
    public function managecustomer() {
        $custModel = $this->model('CustomerModel');
        $customers = $custModel->get_customers();

        $this->view('admin/layout/header');
        $this->view('admin/layout/sidelink', array(
            "mcustomers" => true
        ));
        $this->view('admin/managecustomer', array(
            'customers' => $customers
        ));
        $this->view('admin/layout/footer');
    }
    public function viewcustomer() {
        if(!isset($_GET['id']))
            $this->redirect('admin/managecustomer');

        $custModel = $this->model('CustomerModel');
        $customer = $custModel->get_by_id($_GET['id']);
        $prodModel = $this->model('DeviceModel');
        $devices = $prodModel->get_by_customer_id($_GET['id']);
        $serModel = $this->model('ServiceModel');
        $faults = $serModel->get_by_customer_id('fault_repair', $_GET['id']);
        // $faults = $serModel->get_by_customer_id('fault_repair');

        $this->view('admin/layout/header');
        $this->view('admin/layout/sidelink', array(
            "mcustomers" => true
        ));
        $this->view('admin/viewcustomer', array(
            'customer' => $customer,
            'devices' => $devices,
            'faults' => $faults
        ));
        $this->view('admin/layout/footer');
    }
    public function addcustomer() {
        if(isset($_POST['submit'])) {
            $custModel = $this->model('CustomerModel');
            $status = $custModel->insert_customer($_POST);

            if($status->error) {
                echo 'Fail : '.$status->message;
            } else {
                echo 'Success';
                $this->redirect('admin/managecustomer');
                exit();
            }
        }
        $this->view('admin/layout/header');
        $this->view('admin/addcustomer');
        $this->view('admin/layout/footer');
    }
    public function editcustomer() {
        if(!isset($_GET['id']))
            $this->redirect('admin/managecustomer');

        $custModel = $this->model('CustomerModel');
        
        if(isset($_POST['submit'])) {
            $status = $custModel->update_customer($_POST);

            if($status->error) {
                echo 'Fail : '.$status->message;
            } else {
                echo 'Success';
                $this->redirect('admin/managecustomer');
                exit();
            }
        }

        $customer = $custModel->get_by_id($_GET['id']);

        $this->view('admin/layout/header');
        $this->view('admin/editcustomer', array(
            'customer' => $customer
        ));
        $this->view('admin/layout/footer');
    }

    /**
     * Manage engineers
     */
    public function manageengineer() {
        $engModel = $this->model('EngineerModel');
        $engineers = $engModel->get_engineers();

        $this->view('admin/layout/header');
        $this->view('admin/layout/sidelink', array(
            "mengineers" => true
        ));
        $this->view('admin/manageengineer', array(
            'engineers' => $engineers
        ));
        $this->view('admin/layout/footer');
    }
    public function addengineer() {
        if(isset($_POST['submit'])) {
            $engModel = $this->model('EngineerModel');
            $engineer = $engModel->insert_engineer($_POST);

            foreach($_POST['expertise'] as $cat_id) {
                $engModel->insert_expertise($engineer->id, $cat_id);
            }
            
            $this->redirect('admin/manageengineer');
            exit();
        }

        $catModel = $this->model('CategoryModel');
        $cat = $catModel->get_categories();

        $this->view('admin/layout/header');
        $this->view('admin/addEngineer', array(
            'cat' => $cat
        ));
        $this->view('admin/layout/footer');
    }
    public function editengineer() {
        if(!isset($_GET['id']))
            $this->redirect('admin/manageengineer');
        
        $engModel = $this->model('EngineerModel');
        $engineer = $engModel->get_by_id($_GET['id']);

        if(isset($_POST['submit'])) {
            $status = $engModel->update_engineer($_POST);

            if($status->error) {
                echo $status->message;
                exit();
            }
            $this->redirect('admin/manageengineer');
            exit();
        }

        $this->view('admin/layout/header');
        $this->view('admin/editEngineer', array('engineer'=>$engineer));
        $this->view('admin/layout/footer');
    }
    public function deleteengineer() {
        if(!isset($_GET['id']))
            $this->redirect('admin/manageengineer');

        $engModel = $this->model('EngineerModel');
        $status = $engModel->delete_by_id($_GET['id']);
        if(!$status->error) {
            $st = $engModel->delete_expertise_by_engineer_id($_GET['id']);
            if(!$st->error) {
                $this->redirect('admin/manageengineer');
            } else {
                die('#Error : '.$st->message.' <a href="'.SC_URL.'admin/manageengineer">go back</a>');
            }
        } else {
            die('#Error : '.$status->message.' <a href="'.SC_URL.'admin/manageengineer">go back</a>');
        }
    }

    /**
     * Manage Fault Request
     */
    public function managefault() {
        $serviceModel = $this->model('ServiceModel');
        $faults = $serviceModel->get_services('fault_repair');

        $this->view('admin/layout/header');
        $this->view('admin/layout/sidelink', array(
            "mfault" => true
        ));
        $this->view('admin/managefault',array(
            'faults' => $faults
        ));
        $this->view('admin/layout/footer');
    }
    public function addfault() {
        
        if(isset($_POST['submit'])) {
            $serModel = $this->model('ServiceModel');
            $status = $serModel->request_service($_POST);
            if($status->error) {
                die('#Error: '.$status->message.'; Go Back <a href="'.SC_URL.'admin/managefault">here</a>');
            }
            $this->redirect('admin/managefault');
            exit();
        }
        
        $prodModel = $this->model('DeviceModel');
        $devices = $prodModel->get_devices();

        $this->view('admin/layout/header');
        $this->view('admin/addfault', array(
            'devices' => $devices
        ));
        $this->view('admin/layout/footer');
    }
    public function viewfault() {
        if(!isset($_GET['id']))
            $this->redirect('admin/managefault');
        
        $serModel = $this->model('ServiceModel');

        // assign engineer, service charge and give approval
        if(isset($_POST['submit-approve'])) {
            $serModel->approve($_POST);
        }

        $stat = $serModel->get_status('fault_repair', $_GET['id']);

        if($stat->status != 'APPROVED') {
            $fault = $serModel->get_by_id('fault_repair', $_GET['id']);
            if(isset($fault->error) && $fault->error) die('Error: '.$fault->message);
        } else {
            $fault = $serModel->get_by_id_approved('fault_repair', $_GET['id']);
            if(isset($fault->error) && $fault->error) die('Error: '.$fault->message);
        }

        $engineers = null;
        if($fault->status != 'APPROVED') {
            $engModel = $this->model('EngineerModel');
            $engineers = $engModel->get_by_device_category_id($fault->device_category_id);
        }

        $this->view('admin/layout/header');
        $this->view('admin/viewfault',array(
            'fault' => $fault,
            'engineers' => $engineers
        ));
        $this->view('admin/layout/footer');
    }
    
    public function rejectfault() {
        if(isset($_GET['id'])) {
            $serModel = $this->model('ServiceModel');
            $status = $serModel->reject($_GET['id']);
            if($status->error) {
                die('#Error: '.$status->message.' occured: go back <a href="'.SC_URL.'admin">here</a>');
            }
        }
        $this->redirect('admin/managefault');
        exit();
    }

    /**
     * Manage maintenance services
     */
    public function managemaintain() {
        $serviceModel = $this->model('ServiceModel');
        $services = $serviceModel->get_services('fault_repair');

        $this->view('admin/layout/header');
        $this->view('admin/layout/sidelink', array(
            "mmaintain" => true
        ));
        $this->view('admin/managemaintain',array(
            'services' => $services
        ));
        $this->view('admin/layout/footer');
    }

    public function addmaintain() {
        $this->view('admin/layout/header');
        $this->view('admin/addmaintain');
        $this->view('admin/layout/footer');
    }

}
