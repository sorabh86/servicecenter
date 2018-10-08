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
        $services = $serModel->get_by_customer_id('maintenance', $_GET['id']);

        $this->view('admin/layout/header');
        $this->view('admin/layout/sidelink', array(
            "mcustomers" => true
        ));
        $this->view('admin/viewcustomer', array(
            'customer' => $customer,
            'devices' => $devices,
            'faults' => $faults,
            'services' => $services
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
            $serModel->fault_approve($_POST);
        }

        $parts = null;
        $engineers = null;
        $stat = $serModel->get_status('fault_repair', $_GET['id']);

        if($stat->status == 'REQUESTED') {
            $fault = $serModel->get_by_id('fault_repair', $_GET['id']);
            if(isset($fault->error) && $fault->error) die('Error: '.$fault->message);

            $engModel = $this->model('EngineerModel');
            $engineers = $engModel->get_by_device_category_id($fault->device_category_id);
        } else {
            $fault = $serModel->get_by_id_approved('fault_repair', $_GET['id']);
            if(isset($fault->error) && $fault->error) die('Error: '.$fault->message);

            $devModel = $this->model('DeviceModel');
            $parts = $devModel->get_part_by_service_id($_GET['id']);
        }

        $this->view('admin/layout/header');
        $this->view('admin/viewfault',array(
            'fault' => $fault,
            'engineers' => $engineers,
            'parts' => $parts
        ));
        $this->view('admin/layout/footer');
    }
    public function adddevicepart() {
        if(!isset($_GET['id']))
            $this->redirect('admin');

        $serModel = $this->model('ServiceModel');
        $type = $serModel->get_type($_GET['id'])->type;

        $page= 'managefault';
        $redpage = 'viewfault';
        if(isset($type)) {
            if($type == 'maintenance') {
                $page = 'managemaintain';
                $redpage = 'viewmaintain';
            }
        }

        if(isset($_POST['submit'])) {
            $devModel = $this->model('DeviceModel');
            $stat = $devModel->insert_part($_POST);
            if($stat->error) die('Error: '.$stat->message.'. <a href="'.SC_URL.'admin/viewfault?id='.$_GET['id'].'" >goback</a>');
            $this->redirect('admin/'.$redpage.'?id='.$_GET['id']);
            exit();
        }

        $this->view('admin/layout/header');
        $this->view('admin/adddevicepart',array('page'=>$page));
        $this->view('admin/layout/footer');
    }
    public function deletedevicepart() {
        if(isset($_GET['id'])) {

            $serModel = $this->model('ServiceModel');
            $type = $serModel->get_type($_GET['sid'])->type;
            
            $redpage = 'viewfault';
            if(isset($type)) {
                if($type == 'maintenance')
                    $redpage = 'viewmaintain';
            }

            $devModel = $this->model('DeviceModel');
            $stat = $devModel->delete_part_by_id($_GET['id']);
            if($stat->error) die('Error: '.$stat->message.'. <a href="'.SC_URL.'admin/'.$redpage.'?id='.$_GET['sid'].'" >goback</a>');
            
            $this->redirect('admin/'.$redpage.'?id='.$_GET['sid']);
            exit();
        }
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
    public function faultbill() {
        $serModel = $this->model('ServiceModel');
        $stat = $serModel->get_status('fault_repair', $_GET['id']);

        $service = $serModel->get_by_id_approved('fault_repair', $_GET['id']);
        if(isset($service->error) && $service->error) die('Error: '.$fault->message);

        $devModel = $this->model('DeviceModel');
        $parts = $devModel->get_part_by_service_id($_GET['id']);
        if(isset($parts->error) && $parts->error) die('Error: '.$parts->message);

        $this->view('admin/billtemplate',array(
            'page' => 'viewfault',
            'status' => $stat->status,
            'service' => $service,
            'parts' => $parts
        ));
    }

    /**
     * Manage maintenance services
     */
    public function managemaintain() {
        $serviceModel = $this->model('ServiceModel');
        $services = $serviceModel->get_services('maintenance');
        if(isset($services->error) && $services->error) die('Error:'.$services->message.'. <a href="">go back</a>');

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
        if(isset($_POST['submit'])) {
            $serviceModel = $this->model('ServiceModel');
            $_POST['alternative_address'] = '';
            $_POST['alternative_phone'] = '';
            $stat = $serviceModel->insert_approved($_POST);
            if(isset($stat) && $stat->error) die('Error: '.$stat->message.'. <a href="'.SC_URL.'admin/managemaintain">goback</a>');
            $this->redirect('admin/managemaintain');
            exit();
        }

        $devModel = $this->model('DeviceModel');
        $devices = $devModel->get_devices();
        if(isset($devices->error) && $devices->error) die('Error: '.$devices->message.'. <a href="'.SC_URL.'admin/managemaintain">go back</a>');

        $engModel = $this->model('EngineerModel');
        $device_category_id = $devices[0]->device_category_id;
        $engineers = $engModel->get_by_device_category_id($device_category_id);

        $this->view('admin/layout/header');
        $this->view('admin/addmaintain',array(
            'devices'=>$devices,
            'engineers'=>$engineers
        ));
        $this->view('admin/layout/footer');
    }

    public function viewmaintain() {
        if(!isset($_GET['id']))
            $this->redirect('admin/managefault');

        $serModel = $this->model('ServiceModel');
        // assign engineer, service charge and give approval
        if(isset($_POST['submit-approve'])) {
            $serModel->maintain_approve($_POST);
        }

        $parts = null;
        $service = null;
        
        $service = $serModel->get_by_id('maintenance', $_GET['id']);
        if(isset($service->error) && $service->error) die('Error: '.$service->message);
        
        $devModel = $this->model('DeviceModel');
        $parts = $devModel->get_part_by_service_id($_GET['id']);
        
        $this->view('admin/layout/header');
        $this->view('admin/viewmaintain',array(
            'service' => $service,
            'parts' => $parts
        ));
        $this->view('admin/layout/footer');
    }

    public function rejectmaintain() {
        if(isset($_GET['id'])) {
            $serModel = $this->model('ServiceModel');
            $status = $serModel->reject($_GET['id']);
            if($status->error) {
                die('#Error: '.$status->message.' occured: go back <a href="'.SC_URL.'admin">here</a>');
            }
        }
        $this->redirect('admin/managemaintain');
        exit();
    }
    
    public function maintainbill() {
        /* generate bill for only selected parts */
        if(isset($_POST['part-submit'])) {
            $id = $_GET['id'];
            $serModel = $this->model('ServiceModel');
            $str = '<html>
                <head><title>bill</title></head>
                <body style="background:#eee">
                    <div style="margin:auto;width:800px;background:#fff;padding:10px">
                        <div style="padding:20px;overflow:hidden">
                            <a href="'.SC_URL.'admin/viewmaintain?id='.$id.'">< go back</a>
                            <button onclick="window.print()" style="float:right;margin-left:20px">print</button>
                        </div>
                        <table style="width:100%;">
                            <tr style="border-bottom:1px solid #ddd;">
                                <td><image height="60" src="'.SC_URL.'img/logo.png" alt="Service Center"></td>
                                <td></td>
                                <td align="right">Date : '.date('Y-m-d').'</td>
                            </tr>
                        </table>';
            
            if(isset($_POST['parts']) && !empty($_POST['parts'])) {
                $parts = $_POST['parts'];
                $service = $serModel->get_by_id('maintenance', $id);
                if(isset($service->error) && $service->error) die('Error: '.$service->message);

                $address = (isset($service->alternative_address) && $service->alternative_address!='')?$service->alternative_address:$service->address;
                $phone = (isset($service->alternative_phone) && $service->alternative_phone!='')?$service->alternative_phone:$service->phone;
                $total = 0;

                $devModel = $this->model('DeviceModel');

                $date = strtotime($service->requested_date);
                $startdate = date('d F Y', $date);
                $enddate = date('d F Y', strtotime($startdate.' + '.(365*$service->duration).' days'));

                $str .= '<div style="padding:20px;border:1px solid #ccc;">
                        <div>
                            <strong style="display:inline-block;width:150px;">Name: </strong>
                            <span>'.$service->customer_name.'</span>
                        </div>
                        <div>
                            <strong style="display:inline-block;width:150px;">Address: </strong>
                            <span>'.$address.'</span>
                        </div>
                        <div>
                            <strong style="display:inline-block;width:150px;">Phone: </strong>
                            <span>'.$phone.'</span>
                        </div>
                        <div>
                            <strong style="display:inline-block;width:150px;">Description: </strong>
                            <span>'.$service->description.'</span>
                        </div>
                        <div>
                            <strong style="display:inline-block;width:150px;">Start Date: </strong>
                            <span>'.$startdate.'</span>
                        </div>
                        <div>
                            <strong style="display:inline-block;width:150px;">End Date: </strong>
                            <span>'.$enddate.'</span>
                        </div>
                        <div>
                            <strong style="display:inline-block;width:150px;">Duration: </strong>
                            <span>'.$service->duration.' Year\'s</span>
                        </div>
                        <div style="margin-bottom:10px;">
                            <strong style="display:inline-block;width:150px;">Device: </strong>
                            <span>'.$service->device_category_name.': '.$service->brand_name.' '.$service->serial_no.'('.$service->date_of_purchase.')</span>
                        </div>
                    </div>
                    <table style="width:100%;padding:10px;">';
                foreach($parts as $part) {
                    $devPart = $devModel->get_part_by_id($part);
                    if(isset($devPart->error) && $devPart->error) die('Error: '.$devPart->message);
                    $str .= '<tr>
                            <td align="right">'.$devPart->part_name.' </td>
                            <td align="center">____________________</td>
                            <td align="right">'.$devPart->price.'</td>
                        </tr>';
                    $total += $devPart->price;
                }
                $str .= '<tr>
                            <td></td>
                            <td align="right"><strong>TOTAL:</strong></td>
                            <td align="right"><strong>'.number_format($total,2).'</strong></td>
                        </tr>
                    </table>';
            } else {
                $str .= '<p>You have to checked any of replaced parts first, Bill couldn\'t be generated, if their is no replaced parts for generating bill.</p>';
            }

            $str .= '</div>
                </body>
            </html>';
            die($str);
        }

        /* this runs on creating bill for subscription fee only  */
        if(isset($_POST['submit'])) {
            $id = $_POST['id'];
            $serModel = $this->model('ServiceModel');
            $str = '<html>
                <head><title>bill</title></head>
                <body style="background:#eee">
                    <div style="margin:auto;width:800px;background:#fff;padding:10px">
                        <div style="padding:20px;overflow:hidden">
                            <a href="'.SC_URL.'admin/viewmaintain?id='.$id.'">< go back</a>
                            <button onclick="window.print()" style="float:right;margin-left:20px">print</button>
                        </div>
                        <table style="width:100%;">
                            <tr style="border-bottom:1px solid #ddd;">
                                <td><image height="60" src="'.SC_URL.'img/logo.png" alt="Service Center"></td>
                                <td></td>
                                <td align="right">Date : '.date('Y-m-d').'</td>
                            </tr>
                        </table>';
            $stat = $serModel->get_status('maintenance', $id);

            if($stat->status != 'APPROVED') {
                $str .= "<p>Bill cannot be generated for non approved service</p>";
            } else {
                $service = $serModel->get_by_id('maintenance', $id);
                if(isset($service->error) && $service->error) die('Error: '.$service->message);

                $address = (isset($service->alternative_address) && $service->alternative_address!='')?$service->alternative_address:$service->address;
                $phone = (isset($service->alternative_phone) && $service->alternative_phone!='')?$service->alternative_phone:$service->phone;
                $total = $service->price;

                $date = strtotime($service->requested_date);
                $startdate = date('d F Y', $date);
                $enddate = date('d F Y', strtotime($startdate.' + '.(365*$service->duration).' days'));

                $str .= '<div style="padding:20px;border:1px solid #ccc;">
                        <div>
                            <strong style="display:inline-block;width:150px;">Name: </strong>
                            <span>'.$service->customer_name.'</span>
                        </div>
                        <div>
                            <strong style="display:inline-block;width:150px;">Address: </strong>
                            <span>'.$address.'</span>
                        </div>
                        <div>
                            <strong style="display:inline-block;width:150px;">Phone: </strong>
                            <span>'.$phone.'</span>
                        </div>
                        <div>
                            <strong style="display:inline-block;width:150px;">Description: </strong>
                            <span>'.$service->description.'</span>
                        </div>
                        <div>
                            <strong style="display:inline-block;width:150px;">Start Date: </strong>
                            <span>'.$startdate.'</span>
                        </div>
                        <div>
                            <strong style="display:inline-block;width:150px;">End Date: </strong>
                            <span>'.$enddate.'</span>
                        </div>
                        <div>
                            <strong style="display:inline-block;width:150px;">Duration: </strong>
                            <span>'.$service->duration.' Year\'s</span>
                        </div>
                        <div style="margin-bottom:10px;">
                            <strong style="display:inline-block;width:150px;">Device: </strong>
                            <span>'.$service->device_category_name.': '.$service->brand_name.' '.$service->serial_no.'('.$service->date_of_purchase.')</span>
                        </div>
                    </div>
                    <table style="width:100%;padding:10px;">
                        <tr>
                            <td align="right">Subscription Fee: </td>
                            <td align="center">____________________</td>
                            <td align="right">'.$service->price.'</td>
                        </tr>';
                
                $str .= '<tr>
                        <td></td>
                        <td align="right"><strong>TOTAL:</strong></td>
                        <td align="right"><strong>'.number_format($total,2).'</strong></td>
                    </tr>
                </table>';
            }

            $str .= '    </div>
                </body>
            </html>';
            die($str);
        }
    }
}
