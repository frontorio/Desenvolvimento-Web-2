<?php 
class Student extends BaseClass{
	private $place;
	private $university;
	private $since; //date
	private $points;
	private $tried;
	private $submission;

	public function __construct($id, $name, $place, $university, $since, $points, $tried, $submission){
		parent:: __construct($id, $name);
		$this-> place = $place;
		$this-> university = $university;
		$this-> since = $since;
		$this-> points = $points;
		$this-> tried = $tried;
		$this-> submission = $submission;
	}

	public function getPlace(){
		return $this->place;
	}
	public function setPlace($place){
		$this->place = $place;
	}
	public function getUniversity(){
		return $this->university;
	}
	public function setUniversity($university){
		$this->university = $university;
	}
	public function getSince(){
		return $this->since;
	}
	public function setSince($since){
		$this->since = $since;
	}
	public function getPoints(){
		return $this->points;
	}
	public function setPoints($points){
		$this->points = $points;
	}
	public function getTried(){
		return $this->tried;
	}
	public function setTried($tried){
		$this->tried = $tried;
	}
	public function getSubmission(){
		return $this->submission;
	}
	public function setSubmission($submission){
		$this->submission = $submission;
	}

	public function __toString(){
		$result = "{";
		$result .= parent:: __toString();
		$result .= ", place: " .$this->place;
		$result .= ", university: " .$this->university;
		$result .= ", since: " .$this->since;
		$result .= ", points: " .$this-> points;
		$result .= ", tried: " .$this-> tried;
		$result .= ", submission: " .$this-> submission;
		$result .= "}";
		return  $result;
	}
}?> 
