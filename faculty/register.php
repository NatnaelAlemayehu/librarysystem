<?php
	require "../db_connect.php";
	require "../message_display.php";
	require "../header.php";
?>

<html>
	<head>
		<title>LMS</title>
		<link rel="stylesheet" type="text/css" href="../css/global_styles.css">
		<link rel="stylesheet" type="text/css" href="../css/form_styles.css">
		<link rel="stylesheet" href="css/register_style.css">
	</head>
	<body>
		<form class="cd-form" method="POST" action="#">
			<center><legend>Faculty Registration</legend><p>Please fillup the form below:</p></center>
			
				<div class="error-message" id="error-message">
					<p id="error"></p>
				</div>

				<div class="icon">
					<input class="m-name" type="text" name="m_name" placeholder="Full Name" required />
				</div>

				<div class="icon">
					<input class="m-email" type="email" name="m_email" id="m_email" placeholder="Email" required />
				</div>
				
				<div class="icon">
					<input class="m-user" type="text" name="m_user" id="m_user" placeholder="Username" required />
				</div>
				
				<div class="icon">
					<input class="m-pass" type="password" name="m_pass" placeholder="Password" required />
				</div>
			
				
				<!-- <div class="icon">
					<input class="m-balance" type="number" name="m_balance" id="m_balance" placeholder="Initial Balance" required />
				</div> -->
				
				<br />
				<input type="submit" name="m_register" value="Submit" />
		</form>
	</body>
	
	<?php
		if(isset($_POST['m_register']))
		{
			$password = $_POST['m_pass'];
			
			$uppercase = preg_match('@[A-Z]@', $password);
			$lowercase = preg_match('@[a-z]@', $password);
			$number    = preg_match('@[0-9]@', $password);
			$specialChars = preg_match('@[^\w]@', $password);
			if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
				echo error_without_field("Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.");
			}
			else
			{
				$query = $con->prepare("(SELECT username FROM faculty WHERE username = ?) UNION (SELECT username FROM pending_registrations WHERE username = ?);");
				$query->bind_param("ss", $_POST['m_user'], $_POST['m_user']);
				$query->execute();
				if(mysqli_num_rows($query->get_result()) != 0)
					echo error_with_field("The username you entered is already taken", "m_user");
				else
				{
					$query = $con->prepare("(SELECT email FROM faculty WHERE email = ?) UNION (SELECT email FROM pending_registrations WHERE email = ?);");
					$query->bind_param("ss", $_POST['m_email'], $_POST['m_email']);
					$query->execute();
					if(mysqli_num_rows($query->get_result()) != 0)
						echo error_with_field("An account is already registered with that email", "m_email");
					else
					{
						$query = $con->prepare("INSERT INTO pending_registrations(username, password, name, email, category) VALUES(?, ?, ?, ?, ?);");
						$faculty = 'Faculty';
						
						$query->bind_param("sssss", $_POST['m_user'], sha1($_POST['m_pass']), $_POST['m_name'], $_POST['m_email'], $faculty);
						if($query->execute())
							echo success("Details submitted, soon you'll will be notified after verifications!");
						else
							echo error_without_field("Couldn\'t record details. Please try again later");
					}
				}
			}
		}
	?>
	
</html>