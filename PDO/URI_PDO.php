<?php 
interface URI_PDO{
	public function insert($obj);
	public function exists($obj);
	public function delete($obj);
	public function update($obj);
	public function selectById($id);
	public function loadList();
}?> 
