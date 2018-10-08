<?php

class BillModel {

    protected $db;
    function __construct($db){
        $this->db = $db;
    }

    public function get_bills() {
        try {
            $stmt = $this->db->prepare('SELECT * FROM bills');
            $stmt->execute();
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            return (object)array('error'=>true,'message',$e->getMessage());
        }
    }
    public function get_bills_by_customer_id($id) {
        try {
            $stmt = $this->db->prepare('SELECT B.*, D.customer_id FROM bills B
            INNER JOIN services S ON B.service_id=S.id
            INNER JOIN devices D ON S.device_id=D.id 
            WHERE D.customer_id=?');
            $stmt->execute(array($id));
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            return (object)array('error'=>true,'message',$e->getMessage());
        }
    }
    public function get_by_id($id) {
        try {
            $stmt = $this->db->prepare('SELECT * FROM bills WHERE id=?');
            $stmt->execute($id);
            return $stmt->fetch();
        } catch(PDOException $e) {
            return (object)array('error'=>true,'message',$e->getMessage());
        }
    }
    public function insert_bill($post) {
        try {
            $stmt = $this->db->prepare('INSERT INTO bills (service_id, content, cost, status, date) VALUES (?,?,?,?,?)');
            $stmt->execute(array(
                $post['service_id'],
                $post['content'],
                $post['cost'],
                $post['status'],
                $post['date']
            ));
            return (object)array('error'=>false,'message','Successfully Inserted');
        } catch(PDOException $e) {
            return (object)array('error'=>true,'message',$e->getMessage());
        }
    }
    public function insert_billed_part($post) {
        try {
            $stmt = $this->db->prepare('INSERT INTO bill_parts (bill_id,device_part_id) VALUES (?,?)');
            $stmt->execute(array(
                $post['bill_id'],
                $post['device_part_id']
            ));
        } catch(PDOException $e) {
            return (object)array('error'=>true,'message',$e->getMessage());
        }
    }

}