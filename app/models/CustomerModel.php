<?php

class CustomerModel {

    protected $db;
    
    function __construct(PDO $db) {
        $this->db = $db;
    }

    public function customer_exist($username) {
        $stmt = $this->db->query("SELECT id FROM customers");
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
    public function update_customer($post) {
        $sql = "UPDATE INTO customers (password, name, phone, address) VALUES (?,?,?,?) WHERE id=?";
        $stmt = $this->db->prepare($sql);
        if($stmt->execute(array(
            $post['password'],
            $post['name'],
            $post['phone'],
            $post['address'],
            $post['id']
        ))) {
            return true;
        } else {
            return false;
        };
    }

    public function get_by_id($id) {
        $stmt = $this->db->prepare("SELECT * FROM customers WHERE id=?");
        $stmt->execute(array($id));
        return $stmt->fetch();
    }
    
    public function get_customers() {
        $stmt = $this->db->prepare("SELECT * FROM customers");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function delete_customer() {

    }
}