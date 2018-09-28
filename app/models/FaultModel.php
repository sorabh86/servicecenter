<?php

class FaultModel {

    protected $db;

    function __construct($db) {
        $this->db = $db;
    }

    public function get_faults() {
        try {
            $stmt = $this->db->prepare('SELECT FS.*, CONCAT(PC.name,": ",P.brand_name," ",P.serial_no) AS product_name 
            FROM fault_services FS
            INNER JOIN products P ON FS.product_id=P.id
            INNER JOIN product_category PC ON PC.id=P.product_category_id');
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return (object)array(
                'error' => true,
                'message' => $e->getMessage() 
            );
        }
    }

    public function request_fault($post) {
        try {
            $stmt = $this->db->prepare('INSERT INTO fault_services 
                (product_id, alternative_address, alternative_phone, description, status, requested_date) 
                VALUES (?,?,?,?,?,NOW())');
            $stmt->execute(array(
                $post['product_id'],
                $post['alternative_address'],
                $post['alternative_phone'],
                $post['description'],
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