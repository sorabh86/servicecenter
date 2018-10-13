<?php
/**
 * This Model dedicated to get information related to Device Category
 */

class CategoryModel {

    protected $db;
    
    function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * return all records from database
     */
    function get_categories() {
        try {
            $sql = "SELECT * FROM device_category ORDER BY id DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            return (object)array('error'=>true,'message'=>$e.getMessage());
        }
    }

    /**
     * insert new record to database
     * @param name String 
     */
    function insert_category($name) {
        try {
            $stmt = $this->db->prepare("INSERT INTO device_category (`name`) VALUES (?)");
            $stmt->execute(array($name));
        } catch(PDOException $e) {
            return (object)array('error'=>true,'message'=>$e.getMessage());
        }
    }

    /**
     * delete a selected record by id
     * @param id Integer
     */
    function delete_by_id($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM `device_category` WHERE id=?");
            $stmt->execute(array($id));
        } catch(PDOException $e) {
            return (object)array('error'=>true,'message'=>$e.getMessage());
        }
    }

}