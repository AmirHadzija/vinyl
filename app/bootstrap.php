<?php 
	//Skripta koja ucitava sve skripte koje koristi mvc
	//Load Config
	require_once 'config/config.php';
	//load helpers	
	require_once 'helpers/url_helper.php';
	require_once 'helpers/session_helper.php';
	require_once 'helpers/test_input.php';
	require_once 'helpers/img_name_dir.php';	
	require_once 'helpers/dir_is_empty.php';	
	require_once 'helpers/alternative_money.php';	
	require_once 'helpers/mysqli_echo.php';	
	require_once 'helpers/seconds_time.php';	
	require_once 'helpers/text_excerpt.php';	
	require_once 'helpers/htmlpurifier-4.10.0/library/HTMLPurifier.auto.php';	


	//sets script timezone
	date_default_timezone_set('Europe/Belgrade');

	//Autoload Core Libraries
	spl_autoload_register(function($className){
		require_once 'libraries/'. $className .'.php';
	});