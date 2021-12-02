<?php
    require "../db_connect.php";
    require "../message_display.php";
	require "verify_librarian.php";
	require "header_librarian.php";
?>

<html>
	<head>
		<title>LMS</title>
		<link rel="stylesheet" type="text/css" href="../member/css/home_style.css" />
        <link rel="stylesheet" type="text/css" href="../css/global_styles.css">
		<link rel="stylesheet" type="text/css" href="../css/home_style.css">
		<link rel="stylesheet" type="text/css" href="../member/css/custom_radio_button_style.css">
	</head>
	<body>

    <?php
			$query = $con->prepare("SELECT * FROM member");
			$query->execute();
			$result = $query->get_result();
			if(!$result)
				die("ERROR: Couldn't fetch books");
			$rows = mysqli_num_rows($result);
			if($rows == 0)
				echo "<h2 align='center'>No members found</h2>";
			else
			{
				echo "<form class='cd-form'>";
				echo "<div class='error-message' id='error-message'>
						<p id='error'></p>
					</div>";
				echo "<table width='100%' cellpadding=10 cellspacing=10>";
				echo "<tr>
						<th></th>
						<th>Name<hr></th>
						<th>User Name<hr></th>
						<th>Email<hr></th>						
					</tr>";
				for($i=0; $i<$rows; $i++)
				{
					$row = mysqli_fetch_array($result);
					// print_r ($row);					
					echo "<tr>
							<td>
								<label class='control control--radio'>
									<input type='radio' name='rd_book' value=".$row[0]." />
								<div class='control__indicator'></div>
							</td>";
									
					
					echo "<td>".$row[3]."</td>";
					echo "<td>".$row[1]."</td>";
					echo "<td>".$row[4]."</td>";
					
					
					echo "<td><div class='text-center'><a href='dltuser.php?id=".$row['id']."' style='color:#F66; text-decoration:none;'> Remove</a></div></td>";
					echo "</tr>";
				}
				echo "</table>";
				
				echo "</form>";
			}
			
			
		?>

    </body>

</html>