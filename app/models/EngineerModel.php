<?php

class EngineerModel {
    protected $db;
    function __construct($db) {
        $this->db = $db;
    }

    public function get_engineers() {
        try {
            $stmt = $this->db->prepare('SELECT * FROM engineers');
            $stmt->execute();
            return $stmt->fetchAll();
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
    public function insert_engineer($post) {
        try {
            $stmt = $this->db->prepare('INSERT INTO engineers (name, address, date_of_joining) VALUES (?,?,NOW())');
            $stmt->execute(array(
                $post['name'],
                $post['address']
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
}