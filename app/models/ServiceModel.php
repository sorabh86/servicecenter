<?php

class ServiceModel {

    protected $db;

    function __construct($db) {
        $this->db = $db;
    }

    public function get_services($type) {
        try {
            $stmt = $this->db->prepare('SELECT FS.*, P.customer_id, C.name AS customer_name, 
                P.id AS device_id, CONCAT(PC.name,": ",P.brand_name," ",P.serial_no) AS device_name 
            FROM services FS
            INNER JOIN devices P ON P.id=FS.device_id
            INNER JOIN customers C ON C.id=P.customer_id
            INNER JOIN device_category PC ON PC.id=P.device_category_id 
            WHERE FS.type=?');
            $stmt->execute(array($type));
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return (object)array(
                'error' => true,
                'message' => $e->getMessage() 
            );
        }
    }
    public function get_type($id) {
        try {
            $stmt = $this->db->prepare('SELECT type FROM services WHERE id=?');
            $stmt->execute(array($id));
            return $stmt->fetch();
        } catch(PDOException $e) {
            return (object)array(
                'error' => true,
                'message' => $e->getMessage() 
            );
        }
    }
    public function get_status($type, $id) {
        try {
            $stmt=$this->db->prepare('SELECT status FROM services
             WHERE type=? AND id=?');
            $stmt->execute(array($type, $id));
            return $stmt->fetch();
        } catch(PDOException $e) {
            return (object)array('error' => true,'message' => $e->getMessage());
        }
    }

    public function set_status($post) {
        try {
            $stmt=$this->db->prepare('UPDATE services SET status=? WHERE id=?');
            $stmt->execute(array(
                $post['status'],
                $post['id']
            ));
            return $stmt->fetch();
        } catch(PDOException $e) {
            return (object)array('error' => true,'message' => $e->getMessage());
        }
    }
    
    public function get_by_id($type, $id) {
        try {
            $stmt=$this->db->prepare('SELECT S.*, D.customer_id, C.name AS customer_name,
            C.address, C.phone, D.brand_name, D.date_of_purchase, D.device_category_id, 
            D.serial_no, DC.name AS device_category_name
            FROM services S
            INNER JOIN devices D ON D.id=S.device_id 
            INNER JOIN device_category DC ON DC.id=D.device_category_id  
            INNER JOIN customers C ON C.id=D.customer_id
             WHERE S.type=? AND S.id=?');
            $stmt->execute(array($type, $id));
            return $stmt->fetch();
        } catch(PDOException $e) {
            return (object)array('error' => true,'message' => $e->getMessage());
        }
    }
    public function get_by_id_approved($type, $id) {
        try {
            $stmt=$this->db->prepare('SELECT S.*, D.customer_id, C.name AS customer_name,
            C.address, C.phone, D.brand_name, D.date_of_purchase, D.device_category_id, 
            D.serial_no, DC.name AS device_category_name, E.name AS engineer_name
            FROM services S
            INNER JOIN devices D ON D.id=S.device_id 
            INNER JOIN device_category DC ON DC.id=D.device_category_id  
            INNER JOIN customers C ON C.id=D.customer_id  
            INNER JOIN engineers E ON E.id=S.engineer_id
             WHERE S.type=? AND S.id=?');
            $stmt->execute(array($type, $id));
            return $stmt->fetch();
        } catch(PDOException $e) {
            return (object)array('error' => true,'message' => $e->getMessage());
        }
    }
    // return service_id to device_category_id
    public function get_categoryid_by_id($id) {
        try {
            $stmt=$this->db->prepare('SELECT device_category_id FROM services
            INNER JOIN devices ON services.device_id=devices.id
             WHERE services.id=?');
            $stmt->execute(array($id));
            return $stmt->fetch();
        } catch(PDOException $e) {
            return (object)array('error' => true,'message' => $e->getMessage());
        }
    }

    public function get_by_customer_id($type, $customer_id) {
        try {
            $stmt = $this->db->prepare('SELECT FS.*, P.customer_id, C.name AS customer_name,
                CONCAT(PC.name,": ",P.brand_name," ",P.serial_no) AS device_name 
            FROM services FS
            INNER JOIN devices P ON FS.device_id=P.id
            INNER JOIN customers C ON P.customer_id=C.id 
            INNER JOIN device_category PC ON PC.id=P.device_category_id 
            WHERE type=? AND C.id=?');
            $stmt->execute(array($type, $customer_id));
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return (object)array('error' => true,'message' => $e->getMessage());
        }
    }

    public function insert_approved($post) {
        try {
            $stmt = $this->db->prepare('INSERT INTO services(type, device_id, alternative_address, 
                alternative_phone, description, engineer_id, price, status, requested_date) 
                VALUES(?,?,?,?,?,?,?,?,NOW())');
            $stmt->execute(array(
                $post['type'],
                $post['device_id'],
                $post['alternative_address'],
                $post['alternative_phone'],
                $post['description'],
                $post['engineer_id'],
                $post['price'],
                $post['status']
            ));
            return (object)array('error'=>false,'message'=>'successfully inserted');
        } catch (PDOException $e) {
            return (object)array('error'=>true,'message'=>$e->getMessage());
        }
    }

    public function fault_approve($post) {
        try {
            $stmt = $this->db->prepare("UPDATE services SET status='APPROVED', engineer_id=?, price=? WHERE id=?");
            $stmt->execute(array(
                $post['engineer_id'],
                $post['price'],
                $post['id'],
            ));
            return (object)array('error'=>false,'message'=>'Successfully updated');
        } catch(PDOException $e) {
            return (object)array('error'=>true,'message'=>$e->getMessage());
        }
    }
    public function maintain_approve($post) {
        try {
            $stmt = $this->db->prepare("UPDATE services SET status='APPROVED' WHERE id=?");
            $stmt->execute(array(
                $post['id']
            ));
            return (object)array('error'=>false,'message'=>'Successfully updated');
        } catch(PDOException $e) {
            return (object)array('error'=>true,'message'=>$e->getMessage());
        }
    }
    public function reject($id) {
        try {
            $stmt = $this->db->prepare("UPDATE services SET status='REJECTED' WHERE id=?");
            $stmt->execute(array($id));
            return (object)array('error'=>false,'message'=>'Successfully updated');
        } catch(PDOException $e) {
            return (object)array('error'=>true,'message'=>$e->getMessage());
        }
    }

    public function request_service($post) {
        try {
            $stmt = $this->db->prepare('INSERT INTO services 
                (device_id, type, alternative_address, alternative_phone, description, 
                price, duration, status, requested_date) 
                VALUES (?,?,?,?,?,?,?,?,NOW())');
            $stmt->execute(array(
                $post['device_id'],
                $post['type'],
                $post['alternative_address'],
                $post['alternative_phone'],
                $post['description'],
                $post['price'],
                $post['duration'],
                'REQUESTED'
            ));
            return (object)array(
                'error' => false,
                'message' => "Successfully inserted!" 
            );
        } catch (PDOException $e) {
            return (object)array(
                'error' => true,
                'message' => $e->getMessage() 
            );
        }
    }
}