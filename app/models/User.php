<?php 

	class User{
		private $db;

		public function __construct(){
			$this->db = new Database;
		}

		public function register($data){
			$res = $this->findUserByEmailRegistration($data['email']);
			if ($res == 'not_registered') {
				$email = $data['email'];
				$sql = "SELECT id FROM users WHERE email = '$email'";
				$res = $this->db->get_row($sql, true);
				$id = $res->id;
				$first_name = $data['first_name'];
				$last_name = $data['last_name'];
				
				$username = $data['username'];
				$password = $data['password'];
				$sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', username = '$username', email = '$email', password = '$password', permission = 'regular' WHERE id = $id";			
				$this->db->query($sql);
				$sql = "SELECT id_address FROM users WHERE id = $id";
				$res = $this->db->get_row($sql, true);
				$address_id = $res->id_address;
				$sql = "UPDATE address SET address1 = 'not_registered', postal_code = NULL, phone = 'not_registered', id_city= 2 WHERE id = $address_id";				
				if($this->db->query($sql)){
					return true;
				} else {
					return false;
				}

			} elseif (!$res) {
				$sql = "SELECT id FROM city WHERE city = 'not_registered'";
				$row = $this->db->get_row($sql, true);
				$id_city = $row->id;		

				$sql = "INSERT INTO address (id_city) VALUES ('$id_city')";			
					$this->db->query($sql);	

				$first_name = $data['first_name'];
				$last_name = $data['last_name'];
				$email = $data['email'];
				$username = $data['username'];
				$password = $data['password'];

				$sql = "SELECT id FROM images WHERE img_url = 'http://localhost/vinyl/images/users/default-user.png'";
				$row = $this->db->get_row($sql, true);
				$id_img = $row->id;	

				

				$sql = "INSERT INTO users (first_name, last_name, username, email, password, id_address, id_img, permission) 
						VALUES ('$first_name', '$last_name', '$username', '$email', '$password', LAST_INSERT_ID(), '$id_img', 'regular')";

				
				if($this->db->query($sql)){
					return true;
				} else {
					return false;
				}
				
			}

			
		}

		//provera postojanja mejla za musterije
		public function findUserByEmailRegistration($email){
			$sql ="SELECT * FROM users WHERE email = '$email'";
			$row = $this->db->get_row($sql,true);
			if ($row === null) {
				return false;
			}  elseif ($email == $row->email){
				if ($row->permission = 'not_registered') {
					return 'not_registered';
				} else {
					return true;
				}			

			}



			elseif($email === $row->email && $row->permission === 'not_registered'){
				return 'not_registered';
			} else {
				return true;
			}			
		}

		//provera postojanja username-a za musterije
		public function findUserByUsername($username){
			$sql ="SELECT username FROM users WHERE username = '$username'";
			$row = $this->db->get_row($sql,true);			
			if ($row === null) {
				return false;				
			} elseif($username === $row->username){
				$user = $row->username;
				return $user;
			}
		}

		//logovanje putem mejla za musterije
		public function loginEmail($email, $password){
			$sql = "SELECT users.id, users.first_name, users.last_name, users.username, users.password, users.email, users.create_date, users.active, users.id_address, users.id_img, users.permission, images.img_url FROM users JOIN images ON images.id = users.id_img WHERE email = '$email'";
			$row = $this->db->get_row($sql, true);
			
			$hashed_password = $row->password;

			if (password_verify($password, $hashed_password)) {
				return $row;
			} else {
				return false;
			}
		}

		//logovanje putem username-a za musterije
		public function loginUsername($username, $password){			
			$sql = "SELECT users.id, users.first_name, users.last_name, users.username, users.password, users.email, users.create_date, users.active, users.id_address, users.id_img, users.permission, images.img_url FROM users JOIN images ON images.id = users.id_img WHERE username = '$username'";
			$row = $this->db->get_row($sql, true);
			
			$hashed_password = $row->password;

			if (password_verify($password, $hashed_password)) {
				return $row;
			} else {
				return false;
			}
		}

		public function isActive(){				

			if(isset($_SESSION['user']->id)){
				$id = $_SESSION['user']->id;
				$sql = "UPDATE users SET active = 1 WHERE id = '$id'";
				$res = $this->db->query($sql);	
				if ($res) {
					return true;
				} else {
					return false;
				}		
			} else {
				return false;
			}		
		}

		//vracanje active kolone na default kada se izloguje
		public function isInactive(){
			$id = $_SESSION['user']->id;			
			$sql = "UPDATE users SET active = 0 WHERE id = '$id'";
			$res = $this->db->query($sql);
				
		}

		public function user_address($data){
			$id = $data->id;
			$sql = "SELECT id_address FROM users WHERE id = $id";
			$res = $this->db->get_row($sql);
			$address_id = $res[0];
			$sql = "SELECT * FROM address WHERE id = $address_id";
			$res = $this->db->get_row($sql,true);
			return $res;
		}


	}