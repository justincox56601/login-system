<?php
/**'
 * Users controller class
 */

class Users extends Controller{
	public function __construct(){
		$this->userModel = $this->model('User');
	}

	public function login(){
		$data = [
			'title' => 'Login Page',
			'usernameError' => '',
			'passwordError' => '',
		];

		//check for post data and sanitize
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'title' =>'Login Page',
				'username' => trim($_POST['username']),
				'password' => trim($_POST['password']),
				'usernameError' => '',
				'passwordError' => '',
			];

			//check for empty username and password variables
			$data['usernameError'] = (empty($_POST['username']))? 'Please enter a username.' : '';
			$data['passwordError'] = (empty($_POST['password']))? 'Please enter a password.' : '';

			if(empty($data['usernameError']) && empty($data['passwordError'])){
				$loggedInUser = $this->userModel->login($data['username'], $data['password']);
				
				if($loggedInUser){
					$this->createUserSession($loggedInUser);
				}else{
					$data['passwordError'] = 'Username or Password is incorrect, please try again.';
					$this->view('users/login', $data);
				}
			}

			

			
		}

		$this->view('users/login', $data);
	}

	private function createUserSession($user){
		$_SESSION['user_id'] = $user->id;
		$_SESSION['username'] = $user->username;
		$_SESSION['email'] = $user->email;
		header('location:' . URLROOT . '/pages/home');
	}

	public function logout(){
		unset($_SESSION['user_id']);
		unset($_SESSION['username']);
		unset($_SESSION['email']);
		header('location:' . URLROOT . '/pages/home');
	}

	public function register(){
		$data = [
			'title' => "Register Page",
			'username' => '',
			'email' => '',
			'password' => '',
			'usernameError' => '',
			'emailError' =>'',
			'passwordError' => '',
			'confirmPasswordError' => ''
		];

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data = [
				'title' => "Register Page",
				'username' => trim($_POST['username']),
				'email' => trim($_POST['email']),
				'password' => trim($_POST['password']),
				'confirmPassword' => trim($_POST['confirmPassword']),
				'usernameError' => '',
				'emailError' =>'',
				'passwordError' => '',
				'confirmPasswordError' => ''
			];

			//validate fields
			$data = $this->validateUserName($data);
			$data = $this->validateEmail($data);
			$data = $this->validatePassword($data);
			$data = $this->validateConfirmPassword($data);

			//check for errors and create new user in database
			if(empty($data['usernameError']) &&
				empty($data['emailError']) &&
				empty($data['passwordError']) &&
				empty($data['confirmPasswordError'])){
				
					
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

					//getting the user ID for now.  WIll want to  load a user object later for use in other parts of the site.
					$id = $this->userModel->register($data);

					if($id !== FALSE){
						//redirect to login page
						header('location: ' . URLROOT . '/users/login');
					}else{
						die('Something went wrong');
					}
					 
					
			}
		}

		$this->view('users/register', $data);
	}

	private function validateUserName($data){
		//name validate string
		$nameValidation = "/^[a-zA-Z0-9]*$/";

		//validate username is not empty, contains only letters a-z, A-Z, and 0-9, and hasn't already been registered
		if(empty($data['username'])){
			$data['usernameError'] = 'Please enter a username.';
		}elseif(!preg_match($nameValidation, $data['username'])){
			$data['usernameError'] = 'Username can only contain letters and the numbers 0-9.';
		}elseif($this->userModel->findUserByUsername($data['username'])){
			$data['usernameError'] = 'This username has already been registered.';
		}

		return $data;
	}

	private function validateEmail($data){

		//check if email is empty, contains proper email formatting, and hasn't already been registered
		if(empty($data['email'])){
			$data['emailError'] = 'Please enter an email.';
		}else{
			$data['email'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
			if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
				$data['emailError'] = 'Please enter a valid email format.';
			}elseif($this->userModel->findUserByEmail($data['email'])){
				$data['emailError'] = 'This email already has been registered';
			}
		}

		return $data;
	}

	private function validatePassword($data){

		//password validation string - require 8-20 letters, at least 1 capital, at least 1 number, and at least 1 special character
		$passwordValidtation = "/^(?=.{8,20}$)(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])([a-zA-Z0-9!@#$%^&*]*)$/i";

		//check if password is empty
		if(empty($data['password'])){
			$data['passwordError'] = 'Please enter a password';
		}elseif(!preg_match($passwordValidtation, $data['password'])){
			$data['passwordError'] = 'Please enter a proper password format';
		}
		
		return $data;
	}

	private function validateConfirmPassword($data){
		if(empty($data['confirmPassword'])){
			$data['confirmPasswordError'] = 'Please confirm your password';
		}elseif($data['confirmPassword'] != $data['password']){
			$data['passwordError'] = 'Passwords do not match';
		}

		return $data;
	}
}