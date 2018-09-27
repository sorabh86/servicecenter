<?php

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
                INNER JOIN product_category PC ON EE.product_category_id=PC.id
                GROUP BY E.id');
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
        $stmt = $this->db->prepare('SELECT * FROM engineers WHERE id=?');
        $stmt->execute(array($id));
        return $stmt->fetch();
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
                'message' => 'success',
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
    public function insert_expertise($id, $cat_id) {
        $stmt = $this->db->prepare('INSERT INTO engineers_expertise (product_category_id, engineer_id) VALUES (?,?)');
        $stmt->execute(array($cat_id, $id));
    }
}