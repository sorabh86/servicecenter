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
     * Manage devices or product added by customer or added by admin
     */
    public function manageproduct() {
        $prodModel = $this->model('ProductModel');
        $products = $prodModel->get_products();

        $this->view('admin/layout/header');
        $this->view('admin/layout/sidelink', array(
            "mproduct" => true
        ));
        $this->view('admin/manageproduct', array(
            'products' => $products
        ));
        $this->view('admin/layout/footer');
    }
    public function addproduct() {
        $post = $_POST;
        if(isset($post['submit'])) {
            $prodModel = $this->model('ProductModel');

            $status =$prodModel->insert_product($post); 
            if($status->error) {
                echo '<br> fail'.$status->message;
            } else {
                echo '<br> success';
                $this->redirect('admin/manageproduct');
                exit();
            }
        }

        $catModel = $this->model('CategoryModel');
        $categories = $catModel->get_categories();
        $custModel = $this->model('CustomerModel');
        $customers = $custModel->get_customers();

        $this->view('admin/layout/header');
        $this->view('admin/addproduct', array(
            'customers' => $customers,
            'cat' => $categories
        ));
        $this->view('admin/layout/footer');
    }
    public function editproduct() {
        if(!isset($_GET['id']))
            $this->redirect('admin/manageproduct');

        $prodModel = $this->model('ProductModel');
        $product = $prodModel->get_by_id($_GET['id']);
        
        if(isset($_POST['submit'])) {
            $status = $prodModel->update_product($_POST);
            if($status->error) {
                echo '<br> fail:'.$status->message;
            } else {
                echo "<br> success";
                $this->redirect('admin/manageproduct');
                exit();
            }
        }

        $catModel = $this->model('CategoryModel');
        $categories = $catModel->get_categories();
        $custModel = $this->model('CustomerModel');
        $customers = $custModel->get_customers();

        $this->view('admin/layout/header');
        $this->view('admin/editproduct', array(
            'customers' => $customers,
            'cat' => $categories,
            'product' => $product
        ));
        $this->view('admin/layout/footer');
    }
    public function deleteproduct() {
        if(!isset($_GET['id']))
            $this->redirect('admin/manageproduct');
        
        $prodModel = $this->model('ProductModel');
        $status = $prodModel->delete_by_id($_GET['id']);
        if($status->error) {
            echo '<br> fail:'.$status->message;
        } else {
            echo "<br> success";
            $this->redirect('admin/manageproduct');
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
        $prodModel = $this->model('ProductModel');
        $products = $prodModel->get_by_customer_id($_GET['id']);

        $this->view('admin/layout/header');
        $this->view('admin/layout/sidelink', array(
            "mcustomers" => true
        ));
        $this->view('admin/viewcustomer', array(
            'customer' => $customer,
            'products' => $products
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

    }

    /**
     * Manage Fault Request
     */
    public function managefault() {
        $this->view('admin/layout/header');
        $this->view('admin/layout/sidelink', array(
            "mfault" => true
        ));
        $this->view('admin/managefault');
        $this->view('admin/layout/footer');
    }
    public function managemaintain() {
        $this->view('admin/layout/header');
        $this->view('admin/layout/sidelink', array(
            "mmaintain" => true
        ));
        $this->view('admin/managemaintain');
        $this->view('admin/layout/footer');
    }

}
