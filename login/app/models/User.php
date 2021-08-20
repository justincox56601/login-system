<?php
/**
 * User model
 */

class User{
	private $db;

	public function __construct(){
		$this->db = Database::getInstance();
	}

	public function register($data){
		//returns the new user id if successful or false if unsuccessful
		$this->db->query('INSERT INTO users VALUES (NUll, CURRENT_TIMESTAMP, ?, ?, ?)');
		$this->db->bind($data['username'], 's');
		$this->db->bind($data['email'], 's');
		$this->db->bind($data['password'], 's');
		
		return $this->db->insert();


	}

	public function login($username, $password){
		$this->db->query('SELECT * FROM users WHERE username=?');
		$this->db->bind($username, 's');
		$user = $this->db->getSingle();

		if($user){
			if(password_verify($password, $user->password)){
				return $user;
			}
		}

		return false;
	}


	public function getUsers(){
		$this->db->query('SELECT * FROM users');
		return $this->db->getResults();
	}

	public function findUserByUsername($username){
		$this->db->query('SELECT * FROM users WHERE username=?');
		$this->db->bind($username, 's');
		$result = $this->db->getResults();

		//if numRows > 0, the email has already been registered and will return true
		return (sizeof($result) > 0);
		
	}

	public function findUserByEmail($email){
		$this->db->query('SELECT * FROM users WHERE email=?');
		$this->db->bind($email, 's');
		$result = $this->db->getResults();

		//if numRows > 0, the email has already been registered and will return true
		return (sizeof($result) > 0);
		
	}
}