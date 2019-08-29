<?php 
abstract class BaseClass{
	private $id;
	private $name;

	public function __construct($id, $name){
		$this-> id = $id;
		$this-> name = $name;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	public function getName(){
		return $this->name;
	}
	public function setName($name){
		$this->name = $name;
	}
	

	public function __toString(){
		$result = "{";
		$result .= "id: " .$this->id;
		$result .= ", name: " .$this-> name;
		$result .= "}";
		return  $result;
	}
}?> 
