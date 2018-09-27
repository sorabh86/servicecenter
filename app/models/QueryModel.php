<?php 
/**
* 
*/
class QueryModel
{
	
	function __construct(PDO $db) {
		$this->db = $db;
	}

	public function saveQuery($post) {
		$stmt = $this->db->prepare('INSERT INTO queries(name,phone,email,message) VALUES(?,?,?,?)');
		$stmt->execute([
			$post['name'],
			$post['phone'],
			$post['email'],
			$post['message']
		]);
	}
}