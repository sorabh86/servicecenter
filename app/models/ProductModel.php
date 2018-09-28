<?php


class ProductModel {
    protected $db;

    function __construct($db) {
        $this->db = $db;
    }

    public function get_products() {
        try {
            $stmt = $this->db->prepare('SELECT P.*, C.name AS customer_name, PD.name AS product_category_name FROM products P 
                INNER JOIN customers C ON P.customer_id=C.id 
                INNER JOIN product_category PD ON P.product_category_id=PD.id');
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
                PD.name AS product_category_name FROM products P
                INNER JOIN customers C ON P.customer_id=C.id
                INNER JOIN product_category PD ON P.product_category_id=PD.id
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
            $stmt = $this->db->prepare('SELECT * FROM products WHERE id=?');
            $stmt->execute(array($id));
            return $stmt->fetch();
        } catch (PDOException $e) {
            return (object)array(
                'error' => true,
                'message' => $e->getMessage() 
            );
        }
    }
    public function update_product($post) {
        try {
            $stmt = $this->db->prepare('UPDATE products SET customer_id=?, product_category_id=?, 
                brand_name=?, serial_no=?, purchase_price=?, date_of_purchase=? WHERE id=?');
            $stmt->execute(array(
                $post['customer_id'],
                $post['product_category_id'],
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

    public function insert_product($post) {
        try {
            $stmt = $this->db->prepare('INSERT INTO products (customer_id, product_category_id, brand_name, serial_no, purchase_price, date_of_purchase) VALUES (?,?,?,?,?,?)');
            $stmt->execute(array(
                $post['customer_id'],
                $post['product_category_id'],
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
            $stmt = $this->db->prepare("DELETE FROM `products` WHERE id=?");
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
}