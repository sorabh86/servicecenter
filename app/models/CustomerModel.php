<?php

class CustomerModel {

    protected $db;
    
    function __construct(PDO $db) {
        $this->db = $db;
    }

    public function customer_exist($username) {
        $stmt = $this->db->prepare("SELECT id FROM customers WHERE username=?");
        $stmt->execute(array($username));
        if($stmt->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function authenticate($post) {
        $stmt = $this->db->prepare("SELECT * FROM customers WHERE username=? AND password=?");
        $stmt->execute(array(
            $post['username'], 
            $post['password']
        ));

        if($stmt->rowCount() == 0) {
            return false;
        } else {
           return $stmt->fetch();
        }
    }

    public function insert_customer($post) {
        $sql = "INSERT INTO customers (username, password, name, phone, address) VALUES (?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        if($stmt->execute(array(
            $post['username'],
            $post['password'],
            $post['name'],
            $post['phone'],
            $post['address']
        ))) {
            return true;
        } else {
            return false;
        };
    }
    public function change_password($post) {
        try {
            $sql = "UPDATE customers SET password=? WHERE id=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array(
                $post['password'],
                $post['id']
            ));
            return (object)array('error'=>false,'message'=>'Update Successfully');
        } catch(PDOException $e) {
            return (object)array('error'=>true,'message'=>$e->getMessage());
        }
    }
    public function update_customer($post) {
        try {
            $sql = "UPDATE customers SET name=?, phone=?, address=? WHERE id=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array(
                $post['name'],
                $post['phone'],
                $post['address'],
                $post['id']
            ));
            return (object)array('error'=>false,'message'=>'Update Successfully');
        } catch(PDOException $e) {
            return (object)array('error'=>true,'message'=>$e->getMessage());
        }
    }

    public function get_by_id($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM customers WHERE id=?");
            $stmt->execute(array($id));
            return $stmt->fetch();
        } catch(PDOException $e) {
            return (object)array('error'=>true,'message'=>$e->getMessage());
        }
    }
    
    public function get_customers() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM customers ORDER BY id DESC");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return (object)array('error'=>true,'message'=>$e->getMessage());
        }
    }

    public function delete_customer() {

    }
}