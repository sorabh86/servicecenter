<?php


class DeviceModel {
    protected $db;

    function __construct($db) {
        $this->db = $db;
    }

    public function get_devices() {
        try {
            $stmt = $this->db->prepare('SELECT P.*, C.name AS customer_name, PD.name AS device_category_name FROM devices P 
                INNER JOIN customers C ON P.customer_id=C.id 
                INNER JOIN device_category PD ON P.device_category_id=PD.id');
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return (object)array(
                'error' => true,
                'message' => $e->getMessage() 
            );
        }
    }
    public function get_by_customer_id($id) {
        try {
            $stmt = $this->db->prepare('SELECT P.*, C.name AS customer_name,
                PD.name AS device_category_name FROM devices P
                INNER JOIN customers C ON P.customer_id=C.id
                INNER JOIN device_category PD ON P.device_category_id=PD.id
                WHERE customer_id=?');
            $stmt->execute(array($id));
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return (object)array(
                'error' => true,
                'message' => $e->getMessage() 
            );
        }
    }
    public function get_by_id($id) {
        try {
            $stmt = $this->db->prepare('SELECT * FROM devices WHERE id=?');
            $stmt->execute(array($id));
            return $stmt->fetch();
        } catch (PDOException $e) {
            return (object)array(
                'error' => true,
                'message' => $e->getMessage() 
            );
        }
    }
    public function update_device($post) {
        try {
            $stmt = $this->db->prepare('UPDATE devices SET customer_id=?, device_category_id=?, 
                brand_name=?, serial_no=?, purchase_price=?, date_of_purchase=? WHERE id=?');
            $stmt->execute(array(
                $post['customer_id'],
                $post['device_category_id'],
                $post['brand_name'],
                $post['serial_no'],
                $post['purchase_price'],
                $post['date_of_purchase'],
                $post['id']
            ));
            return (object)array(
                'error' => false,
                'message' => 'Update Successfully' 
            );
        } catch (PDOException $e) {
            return (object)array(
                'error' => true,
                'message' => $e->getMessage() 
            );
        }
    }

    public function insert_device($post) {
        try {
            $stmt = $this->db->prepare('INSERT INTO devices (customer_id, device_category_id, brand_name, serial_no, purchase_price, date_of_purchase) VALUES (?,?,?,?,?,?)');
            $stmt->execute(array(
                $post['customer_id'],
                $post['device_category_id'],
                $post['brand_name'],
                $post['serial_no'],
                $post['purchase_price'],
                $post['date_of_purchase']
            ));
            return (object)array(
                'error' => false,
                'message' => 'success' 
            );
        } catch (PDOException $e) {
            return (object)array(
                'error' => true,
                'message' => $e->getMessage() 
            );
        }
    }

    public function delete_by_id($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM `devices` WHERE id=?");
            $stmt->execute(array($id));
            return (object)array(
                'error' => false,
                'message' => 'success' 
            );
        } catch(PDOException $e) {
            return (object)array(
                'error' => true,
                'message' => $e->getMessage() 
            );
        }
    }

    public function get_part_by_id($id) {
        try {
            $stmt = $this->db->prepare('SELECT * FROM device_parts WHERE id=?');
            $stmt->execute(array($id));
            return $stmt->fetch();
        } catch(PDOException $e) {
            return (object)array('error'=>true,'message'=>$e->getMessage());
        }
    }

    public function get_part_by_service_id($id) {
        try {
            $stmt = $this->db->prepare('SELECT * FROM device_parts WHERE service_id=?');
            $stmt->execute(array($id));
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            return (object)array('error'=>true,'message'=>$e->getMessage());
        }
    }
    public function insert_part($post) {
        try {
            $stmt = $this->db->prepare('INSERT INTO device_parts (service_id,part_name,description,price,date) VALUES (?,?,?,?,NOW())');
            $stmt->execute(array(
                $post['service_id'],
                $post['part_name'],
                $post['description'],
                $post['price']
            ));
            return (object)array('error'=>false,'message'=>'Successfully Added');
        } catch (PDOException $e) {
            return (object)array('error'=>true,'message'=>$e->getMessage());
        }
    }
    public function delete_part_by_id($id) {
        try {
            $stmt = $this->db->prepare('DELETE FROM device_parts WHERE id=?');
            $stmt->execute(array($id));
            return (object)array('error'=>false,'message'=>'Deleted Successfully');
        } catch(PDOException $e) {
            return (object)array('error'=>true,'message'=>$e->getMessage());
        }
    }
}