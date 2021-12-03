<?php
	session_start();
	
	if(empty($_SESSION['type']))
		header("Location: ..");
	
	else if(strcmp($_SESSION['type'], "member") == 0)
		header("Location: ../member/home.php");
	else if(strcmp($_SESSION['type'], "librarian") == 0)
		header("Location: ../librarian/home.php");
	else if(strcmp($_SESSION['type'], "staff") == 0)
		header("Location: ../staff/home.php");
	else if(strcmp($_SESSION['type'], "faculty") == 0)
		header("Location: ../faculty/home.php");	
?>