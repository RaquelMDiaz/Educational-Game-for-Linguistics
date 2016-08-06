<?php
/*checks that session is not hijacked & that page is accessed in correct way (via index.php -> special session variable must be set)*/

	session_start();
	
	$access = true;
	if (!isset($_SESSION['dse87jw'])) { //if not accessed via start page where this variable is set
		$access = false;
	}
	else if (isset($_SESSION['user_ip'])) {
		if ($_SESSION['user_ip'] != $_SERVER['REMOTE_ADDR']){ // prevent hijacking
			$access = false;
		}
	}
	else if(!(isset($_SESSION['user']))) {
		$access = false;
	}
	if ($access == false){
		include 'invalid_access.php';
		die;
	}
	
?>