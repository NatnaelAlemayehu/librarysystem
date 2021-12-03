<?php
	require "db_connect.php";
	require "header.php";
	session_start();
	
	if(empty($_SESSION['type']));
	else if(strcmp($_SESSION['type'], "librarian") == 0)
		header("Location: librarian/home.php");
	else if(strcmp($_SESSION['type'], "member") == 0)
		header("Location: member/home.php");
?>
	
<html>
	<head>
		<title>LMS</title>
		<link rel="stylesheet" type="text/css" href="css/index_style.css" />
	</head>
	<body>
		<div id="allTheThings">
			
			<div id="member">
				<a href="member">
					<img src="img/ic_membership.svg" width="250px" height="auto"/><br />
					&nbsp;Student Login
				</a>
			</div>
				
			<div id="verticalLine">
				<div id="faculty">
					<a href="faculty">
						<img src="img/faculty.jfif" width="250px" height="auto"/><br />
						&nbsp;Faculty Login
					</a>
				</div>	
			</div>
			<div id="verticalLine">
			
				<div id="staff">
					<a href="staff">
						<img src="img/staff.jpg" width="250px" height="auto"/><br />
						&nbsp;Staff Login
					</a>
				</div>	
					
			</div>
			<div id="verticalLine">
				<div id="librarian">
					<a id="librarian-link" href="librarian">
						<img src="img/librarian.jfif" width="250px" height="auto" /><br />
						&nbsp;&nbsp;&nbsp;Librarian Login
					</a>
				</div>
			</div>
			<div id="verticalLine">
			
				<div id="admin">
					<a href="admin">
						<img src="img/admin.png" width="250px" height="auto"/><br />
						&nbsp;Admin Login
					</a>
				</div>
			</div>
			
		</div>
	</body>
</html>