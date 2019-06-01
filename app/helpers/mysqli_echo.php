<?php 

	function mysqli_echo($string){
		$res = nl2br(stripslashes($string));

		return $res;
	}