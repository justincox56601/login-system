<?php
/**
 * Main page view
 */

 class Page{
	private $db;

	public function __construct(){
		$this->db = Database::getInstance();
	}

	public function getPages($params){
		$this->db->query('SELECT * FROM pages WHERE slug=?');
		$this->db->bind($params, 's');
		return $this->db->getResults();
	}
 }