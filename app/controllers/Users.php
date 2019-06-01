<?php 	

	class Users extends Controller{

		public $msg = [];
		

		public function __construct(){
			$this->userModel = $this->model('User');
		}
		

		public function register(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['register'] == 1){

				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				$data = [
					'first_name' => test_input($_POST['first_name']),
					'last_name' => test_input($_POST['last_name']),
					'email' => test_input($_POST['email']),
					'username' => test_input($_POST['username']),
					'password' => test_input($_POST['password']),
					'confirm_password' => test_input($_POST['confirm_password']),
				];

				//Validate first_name 
				$pattern = "/^(([A-za-z]+[\s]{1}[A-za-z]+)|([A-Za-z]+))$/";
				preg_match_all($pattern, $data['first_name'], $matches, PREG_SET_ORDER, 0);				
				if (empty($data['first_name'])) {
					$this->msg['first_name_err'] = 'Please enter your first name';
				} elseif (empty($matches)) {
					$this->msg['first_name_err'] = 'First name can not contain special characters or numbers';
				} else {
					$this->msg['first_name_ok'] = 'Looks good!';
				}

				//validate last name
				preg_match_all($pattern, $data['last_name'], $matches, PREG_SET_ORDER, 0);
				if (empty($data['last_name'])) {
					$this->msg['last_name_err'] = 'Please enter your last name';
				} elseif (empty($matches)) {
					$this->msg['last_name_err'] = 'Last name can not contain special characters or numbers';
				} else {
					$this->msg['last_name_ok'] = 'Looks good!';
				}

				//validate email			
				if (empty($data['email'])) {
					$this->msg['email_err'] = 'Please enter email';
				} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					$this->msg['email_err'] = 'Email format not supported';
				} elseif($this->userModel->findUserByEmailRegistration($data['email']) == 'not_registered'){
					$this->msg['email_ok'] = 'Looks good!';
				} elseif($this->userModel->findUserByEmailRegistration($data['email'])) {				
						$this->msg['email_err'] = 'Email is already being used';				
				} else {
					$this->msg['email_ok'] = 'Looks good!';
				}

				//validate username
				$username = $this->userModel->findUserByUsername($data['username']);
				$pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,20}$/';
				preg_match_all($pattern, $data['username'], $matches, PREG_SET_ORDER, 0);
				if (empty($data['username'])) {
					$this->msg['username_err'] = 'Please enter username';
				} elseif (empty($matches)) {
					$this->msg['username_err'] = 'Username format not supported';
				} elseif ($username === $data['username']){				
						$this->msg['username_err'] = 'Username is already being used';				
				} else {
					$this->msg['username_ok'] = 'Looks good!';
				}

				//validate password
				$pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$/';
				preg_match_all($pattern, $data['password'], $matches, PREG_SET_ORDER, 0);
				if (empty($data['password'])) {
					$this->msg['password_err'] = 'Please enter password';
				} elseif (empty($matches)) {
					$this->msg['password_err'] = 'Password format not supported';
				} else {
					$this->msg['password_ok'] = 'Looks good!';
				}

				//validate confirm password
				preg_match_all($pattern, $data['confirm_password'], $matches, PREG_SET_ORDER, 0);
				if (empty($data['confirm_password'])) {
					$this->msg['confirm_password_err'] = 'Please confirm password';
				} elseif ($data['password'] != $data['confirm_password']){			
						$this->msg['confirm_password_err'] = 'Passwords do not match';				
						$this->msg['password_err'] = 'Passwords do not match';				
				} elseif(empty($matches)) {
					$this->msg['confirm_password_err'] = 'Password format not supported';				
				} else {
					$this->msg['confirm_password_ok'] = 'Looks good!';
				}
				

				if (!isset($this->msg['first_name_err']) && !isset($this->msg['last_name_err']) && !isset($this->msg['email_err']) &&!isset($this->msg['username_err']) && !isset($this->msg['password_err']) && !isset($this->msg['confirm_password_err'])) {
					
					//HASH PASSWORD
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);					
					//REGISTER USER
					if ($this->userModel->register($data)) {	
						$this->msg['success'] = 1;		
						$result = json_encode($this->msg);
						flash('register_success', 'You are registered and can log in');
						exit($result);
					} else {
						$this->msg['failure'] = "Something went wrong with your registration attempt! Please try again later!";		
						$result = json_encode($this->msg);
						exit($result);
					}
				} else {
					$result = json_encode($this->msg);
					exit($result);
				}			
			} else {
				$data = [
					'first_name' => '',
					'last_name' => '',
					'email' => '',
					'username' => '',
					'password' => '',
					'confirm_password' => '',
				];
				$this->view('users/register', $data);
			}		
		}

		public function login(){


			if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['login'] == 1) {

				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				$data = [
					'email_username' => test_input($_POST['email_username']),
					'password' => test_input($_POST['password']),
				];	


				//VALIDATE INPUT FIELDS if empty, AND IF INPUT FORMAT IS ALLOWED

				if (empty($data['email_username']) || empty($data['password'])) {
					$this->msg['failure'] = 'Please complete all required fields';
					$result	= json_encode($this->msg);
					exit($result);
				} else {

					$pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,20}$/';
					preg_match_all($pattern, $data['email_username'], $matches, PREG_SET_ORDER, 0);										
					if (filter_var($data['email_username'], FILTER_VALIDATE_EMAIL)) {
						if (!filter_var($data['email_username'], FILTER_VALIDATE_EMAIL)) {
							$this->msg['failure'] = 'Email, username or password format not supported. Please try again';
							$result	= json_encode($this->msg);
							exit($result);
						}
					} elseif (empty($matches)) {
						$this->msg['failure'] = 'Email, username or password format not supported. Please try again';
						$result	= json_encode($this->msg);
						exit($result);
					}

					$pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$/';
					preg_match_all($pattern, $data['password'], $matches, PREG_SET_ORDER, 0);					
					if (empty($matches)) {
						$this->msg['failure'] = 'Email, username or password format not supported. Please try again';
						$result	= json_encode($this->msg);
						exit($result);
					}
				} 

				

				if (!isset($this->msg['failure'])) {
					if ($this->userModel->findUserByEmailRegistration($data['email_username'])) {
						$loggedInUser = $this->userModel->loginEmail($data['email_username'], $data['password']);
						if ($loggedInUser) {
							$this->createUserSession($loggedInUser);							
						} else{
							$this->msg['failure'] = 'Invalid email, username or password. Please try again';
							$result	= json_encode($this->msg);
							exit($result);
						}
						
					} 

					if ($this->userModel->findUserByUsername($data['email_username'])) {						
						$loggedInUser = $this->userModel->loginUsername($data['email_username'], $data['password']);
						if ($loggedInUser) {
							$this->createUserSession($loggedInUser);	
						} else {
							$this->msg['failure'] = 'Invalid email, username or password. Please try again';
							$result	= json_encode($this->msg);
							exit($result);
						}						
					} else {
						$this->msg['failure'] = 'Invalid email, username or password. Please try again';
						$result	= json_encode($this->msg);
						exit($result);
					}
				}       

			} else {

				$data = [
					'email_username' => '',
					'password' => '',
				];

				$this->view('users/login', $data);
				
			}			
		}

		public function createUserSession($user){

			$_SESSION['user'] =$user;
			unset($_SESSION['user']->password);
			$this->userModel->isActive();
			$this->msg['user_status'] = 'logged_in';
			$result	= json_encode($this->msg);
			exit($result);
			
		}

		public function logout(){
			$this->userModel->isInactive();
			unset($_SESSION['user']);
			redirect('users/login');	
		}

		
	}