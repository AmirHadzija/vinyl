<?php 

	class ErrorHandler{
		private $db;		

		public function __construct(){
			$this->db = new Database;
		}

		public function error_log($error){
			$sql = "INSERT INTO errors (error_log) VALUES ('$error')";

			$res = $this->db->query($sql);

			if ($res) {
				return true;
			} else {
				return false;
			}
		}
	}