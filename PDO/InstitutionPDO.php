<?php 
require_once("Autoload.php");

class InstitutionPDO extends MariaPDO implements URI_PDO{
	

	function __construct($con, $user, $pass){
		parent:: __construct($con, $user, $pass);
	}

	public function insert($obj){ //Receives "Institution" object.
		$pdo = parent:: getPDO();               
		try {
			$stmt = $pdo->prepare('insert into Institution (name) values (:n)');
			$nome = $obj-> getName();
			$stmt->bindParam(':n', $nome, PDO::PARAM_STR);
			$stmt->execute();
		} catch(PDOException $e) {
			echo "\nError: " . $e-> getMessage();
		}
	}
	
	public function exists($obj){ // Uses "name" as comparator.
		$oReceived = $this-> selectByName($obj-> getName());
		if ($oReceived != null) return true;
		return false;
	}

	public function delete($obj){
		$pdo = parent:: getPDO();
		try{    
			$stmt = $pdo->prepare('delete from Institution where id = :id');
			$stmt-> bindParam(':id', $obj-> getId(), PDO::PARAM_INT);
			$stmt-> execute();
		} catch(PDOException $e) {
			echo "\nError: " . $e-> getMessage();
		}
	}
	
	public function update($obj){
		$pdo = parent:: getPDO();
		try{    
			$stmt = $pdo->prepare('update Institution set name = :n where id = :id');
			$stmt-> bindParam(':n', $obj-> getName(), PDO::PARAM_STR);
			$stmt-> bindParam(':id', $obj-> getId(), PDO::PARAM_INT);
			$stmt-> execute();
		} catch(PDOException $e) {
			echo "\nError: " . $e-> getMessage();
		}
	}

	private function select(){
		$pdo = parent:: getPDO();
		try{
			$query = $pdo->query('select * from Institution');
			return $query-> fetchAll();
		} catch(PDOException $e) {
			echo "\nError: " . $e-> getMessage();
		}
	}

	public function selectById($id){
		$arr = $this-> select();
		foreach ($arr as $obj){
			if ($obj["id"] == $id){
				return new Institution($obj["id"], $obj["name"]);
			}
		}
	}
	public function selectByName($name){
		$arr = $this-> select();
		foreach ($arr as $obj){
			if ($obj["name"] == $name){
				return new Institution($obj["id"], $obj["name"]);
			}
		}
	}
	
	public function loadList(){
		$arr = $this-> select();
		$listO = array();
		foreach ($arr as $obj){
			$listO[] = new Institution($obj["id"], $obj["name"]);
		}
		return $listO;
	}

}?> 
