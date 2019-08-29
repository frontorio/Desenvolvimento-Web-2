<?php 
require_once("Autoload.php");

class StudentPDO extends MariaPDO implements URI_PDO{
	public function __construct($con, $user, $pass){
		parent:: __construct($con, $user, $pass);
	}

	//Doesn't inserts "Institution" object. Links it with an existing instance.
	public function insert($obj){ //Receives "Student" object.
		$pdo = parent:: getPDO();               
		try {
			$stmt = $pdo->prepare('insert into Student values (:id, :name, :plac, :sinc, :poin, :trie, :subm, :idI)');
			$stmt->bindParam(':id', $obj-> getId(), PDO::PARAM_INT);
			$stmt->bindParam(':name', $obj-> getName(), PDO::PARAM_STR);
			$stmt->bindParam(':plac', $obj-> getPlace(), PDO::PARAM_STR);
			$stmt->bindParam(':sinc', $obj-> getSince(), PDO::PARAM_STR);
			$stmt->bindParam(':poin', $obj-> getPoints(), PDO::PARAM_STR);
			$stmt->bindParam(':trie', $obj-> getTried(), PDO::PARAM_INT);
			$stmt->bindParam(':subm', $obj-> getSubmission(), PDO::PARAM_INT);
			$stmt->bindParam(':idI', $obj-> getUniversity()-> getId(), PDO::PARAM_INT);
			$stmt->execute();
		} catch(PDOException $e) {
			echo "\nError: " . $e-> getMessage();
		}
	}

	// Automatically inserts "Institution" in case it doesn't exists in database.
	public function autoInsert($obj){
		$iPDO = new InstitutionPDO($this-> getCon(), $this-> getUser(), $this-> getPass());
		if ($iPDO-> exists($obj-> getUniversity())) $this-> insert($obj);
		else {
			$iPDO-> insert($obj-> getUniversity());
			$this-> insert($obj);
		}
	}

	public function exists($obj){
		$oReceived = $this-> selectById($obj-> getId());
		if ($oReceived != null) return true;
		return false;
	}

	public function delete($obj){
		$pdo = parent:: getPDO();
		try{    
			$stmt = $pdo->prepare('delete from Student where id = :id');
			$stmt-> bindParam(':id', $obj-> getId(), PDO::PARAM_INT);
			$stmt-> execute();
		} catch(PDOException $e) {
			echo "\nError: " . $e-> getMessage();
		}
	}
	
	public function update($obj){
		$pdo = parent:: getPDO();
		try{
			$strSt = "update Student set 
				name = :name, place = :plac, since = :sinc, points = :poin, tried = :trie, submission = :subm, idInstitution = :idI
				where id = :id";
			$stmt = $pdo->prepare($strSt);
			$stmt->bindParam(':id', $obj-> getId(), PDO::PARAM_INT);
			$stmt->bindParam(':name', $obj-> getName(), PDO::PARAM_STR);
			$stmt->bindParam(':plac', $obj-> getPlace(), PDO::PARAM_STR);
			$stmt->bindParam(':sinc', $obj-> getSince(), PDO::PARAM_STR);
			$stmt->bindParam(':poin', $obj-> getPoints(), PDO::PARAM_STR);
			$stmt->bindParam(':trie', $obj-> getTried(), PDO::PARAM_INT);
			$stmt->bindParam(':subm', $obj-> getSubmission(), PDO::PARAM_INT);
			$stmt->bindParam(':idI', $obj-> getUniversity()-> getId(), PDO::PARAM_INT);
			$stmt-> execute();
		} catch(PDOException $e) {
			echo "\nError: " . $e-> getMessage();
		}
	}

	private function select(){
		$pdo = parent:: getPDO();
		try{
			$query = $pdo->query('select * from Student');
			return $query-> fetchAll();
		} catch(PDOException $e) {
			echo "\nError: " . $e-> getMessage();
		}
	}

	public function selectById($id){
		$arr = $this-> select();
		foreach ($arr as $obj){
			if ($obj["id"] == $id){
				$oPDO = new InstitutionPDO($this-> getCon(), $this-> getUser(), $this-> getPass());
				$univ = $oPDO-> selectById($obj["idInstitution"]);
				return new Student($obj["id"], $obj["name"], $obj["place"], $univ, $obj["since"], $obj["points"], $obj["tried"], $obj["submission"]);
			}
		}
	}
	
	public function loadList(){
		$arr = $this-> select();
		$listO = array();
		$oPDO = new InstitutionPDO($this-> getCon(), $this-> getUser(), $this-> getPass());
		foreach ($arr as $obj){
			$univ = $oPDO-> selectById($obj["idInstitution"]);
			$listO[] = new Student($obj["id"], $obj["name"], $obj["place"], $univ, $obj["since"], $obj["points"], $obj["tried"], $obj["submission"]);
		}
		return $listO;
	}

}?> 
