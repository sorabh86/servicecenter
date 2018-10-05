<?php

class CategoryModel {

    protected $db;
    
    function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * return all records from database
     */
    function get_categories() {
        $sql = "SELECT * FROM device_category";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * insert new record to database
     * @param name String 
     */
    function insert_category($name) {
        $stmt = $this->db->prepare("INSERT INTO device_category (`name`) VALUES (?)");
        $stmt->execute(array($name));
    }

    /**
     * delete a selected record by id
     * @param id Integer
     */
    function delete_by_id($id) {
        $stmt = $this->db->prepare("DELETE FROM `device_category` WHERE id=?");
        $stmt->execute(array($id));
    }

}