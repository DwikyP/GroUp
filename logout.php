<?php  
	//destroy session
	session_start();
	$_SESSION = [];
	session_unset();
	session_destroy();

	header("Location: index.php");
	exit;
?>