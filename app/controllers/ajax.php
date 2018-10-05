<?php

/**
 * This class help ajax callbacks for javascript
 */

class Ajax extends Controller {

    public function login(){
        $username = isset($_POST['username'])?$_POST['username']:'';
        $password = isset($_POST['password'])?$_POST['password']:'';
        
        if($username!='' || $password!='') {
            $custModel = $this->model('CustomerModel');
            if($user = $custModel->authenticate($_POST)) {
                $_SESSION['user'] = $user;
                echo json_encode(array(
                    'success'=>'Login Successful'
                ));
            } else {
                echo json_encode(array(
                    'error'=>'Username or Password did not matched'
                ));    
            }
        } else {
            echo json_encode(array(
                'error'=>'Username or Password is blank'
            ));
        }
    }

    public function get_engineer_by_expertise() {
        if(!isset($_POST['device_category_id']) && empty($_POST['device_category_id'])) {
            echo json_encode(array(
                'error'=>'No device category id pass.'
            ));exit();
        }

        $engModel = $this->model('EngineerModel');
        $result = $engModel->get_by_device_category_id($_POST['device_category_id']);
        echo json_encode($result);
    }

    public function add_device() {

    }

    public function raise_fault() {

    }
}