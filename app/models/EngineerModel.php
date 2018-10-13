<?php
/**
 * Engineer Related data handle, like fetch, insert, update, delete
 */

class EngineerModel {
    protected $db;
    function __construct($db) {
        $this->db = $db;
    }

    public function get_engineers() {
        try {
            $stmt = $this->db->prepare('SELECT E.*, GROUP_CONCAT(PC.name SEPARATOR " | ") AS 
                expertise FROM `engineers` E
                INNER JOIN `engineers_expertise` EE ON E.id=EE.engineer_id
                INNER JOIN device_category PC ON EE.device_category_id=PC.id
                GROUP BY E.id
                ORDER BY E.id DESC');
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return (object)array(
                'error' => true,
                'message' => $e->getMessage() 
            );
        }
    }
    public function get_by_id($id) {
        try{
            $stmt = $this->db->prepare('SELECT * FROM engineers WHERE id=?');
            $stmt->execute(array($id));
            return $stmt->fetch();
        } catch(PDOException $e) {
            return (object)array(
                'error' => true,
                'message' => $e->getMessage() 
            );
        }
    }

    public function  get_by_device_category_id($id) {
        try {
            $stmt = $this->db->prepare('SELECT e.*, EE.device_category_id FROM engineers E
            INNER JOIN engineers_expertise EE ON EE.engineer_id=E.id
            WHERE EE.device_category_id=?');
            $stmt->execute(array($id));
            return $stmt->fetchAll();
        } catch(PDOException $e) {
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
                'message' => 'Engineer is inserted',
                'id' => $this->db->lastInsertId()
            );
        } catch (PDOException $e) {
            return (object)array(
                'error' => true,
                'message' => $e->getMessage() 
            );
        }
    }
    public function update_engineer($post) {
        try {
            $stmt = $this->db->prepare('UPDATE engineers SET name=?, address=? WHERE id=?');
            $stmt->execute(array($post['name'], $post['address'], $post['id']));
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
    public function delete_by_id($id) {
        try {
            $stmt = $this->db->prepare('DELETE FROM engineers WHERE id=?');
            $stmt->execute(array($id));
            return (object)array(
                'error' => false,
                'message' => 'Engineer is deleted successfully'
            );
        } catch (PDOException $e) {
            return (object)array(
                'error' => true,
                'message' => $e.getMessage()
            );
        }
    }

    public function insert_expertise($id, $cat_id) {
        try {
            $stmt = $this->db->prepare('INSERT INTO engineers_expertise (device_category_id, engineer_id) VALUES (?,?)');
            $stmt->execute(array($cat_id, $id));
            return (object)array(
                'error' => false,
                'message' => 'Engineer expertise inserted'
            );
        } catch (PDOException $e) {
            return (object)array(
                'error' => true,
                'message' => $e.getMessage()
            );
        }
    }
    public function delete_expertise_by_engineer_id($id) {
        try {
            $stmt = $this->db->prepare('DELETE FROM engineers_expertise WHERE engineer_id=?');
            $stmt->execute(array($id));
            return (object)array(
                'error' => false,
                'message' => 'Delete Success'
            );
        } catch(PDOException $e) {
            return (object)array(
                'error' => true,
                'message' => $e.getMessage()
            );
        }
    }
}