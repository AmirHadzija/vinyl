<?php 

	session_start();

	// FLASH MSG HELPER
	function flash($name = '', $message = '', $class = 'alert alert-success'){
		if (!empty($name)) {
			if (!empty($message) && empty($_SESSION[$name])) {
				if (!empty($_SESSION[$name])) {
					unset($_SESSION[$name]);
				}

				if (!empty($_SESSION[$name . '_class'])) {
					unset($_SESSION[$name . '_class']);
				}
				$_SESSION[$name] = $message;
				$_SESSION[$name . '_class'] = $class;
			} elseif (empty($message) && !empty($_SESSION[$name])) {
				$class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
				echo '<div class="text-center'. ' ' .$class .'" id="msg-flash">'.$_SESSION[$name].'</div>';
				unset($_SESSION[$name]);
				unset($_SESSION[$name . '_class']);
			}
		}
	}

	function isLoggedIn($admin = false){

		if (!$admin) {
			if(isset($_SESSION['user']->id) && isset($_SESSION['user']->permission) && $_SESSION['user']->permission != 'admin'){
				return 'regular';
			} elseif(isset($_SESSION['user']->id) && isset($_SESSION['user']->permission) && $_SESSION['user']->permission == 'admin') {
				return 'admin';
			}			
		
		}
		
		

	}

	