<?php 
class MariaPDO {
	private $con;
	private $user;
	private $pass;
	private $pdo;	
	
	// Setting connection "con" to database "A": 'mysql:host=localhost;dbname=A'
	function __construct($con, $user, $pass){
		$this-> pdo = new PDO($con, $user, $pass);
		$this-> pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this-> con = $con;
		$this-> user = $user;
		$this-> pass = $pass;
	}

	public function getCon(){
		return $this->con;
	}
	public function setCon($con){
		$this->con = $con;
	}
	public function getUser(){
		return $this->user;
	}
	public function setUser($user){
		$this->user = $user;
	}
	public function getPass(){
		return $this->pass;
	}
	public function setPass($pass){
		$this->pass = $pass;
	}
	public function getPDO(){
		return $this->pdo;
	}
	public function setPDO($pdo){
		$this->pdo = $pdo;
	}
	
	
	public function __toString(){
		$result = "{";
		$result .= "con: " .$this->con;
		$result .= ", user: " .$this->user;
		$result .= ", pass: " .$this->pass;
		$result .= "}";
		return  $result;
	}
}?>
