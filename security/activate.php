<?php	include('../session/session_checker.php');
		include('../design/header.php');
		include('../database_connection/database_connection.php');	?>

<center>
	<form id="container" style="width:750px;margin:50px" action="activate.php" method="POST">
		<h2>Secret Question</h2>
			<p>Simply answer the random question about your personal information<br/>To activate your account.</p>

<?php

	if (isset($_SESSION['activate'])) {

		$a = array();

		$a[0] = "What is your email address?";
		$a[1] = "What is your height?";
		$a[2] = "What is your civil status?";
		$a[3] = "What is your middle name?";
		$a[4] = "Who is your guardian?";
		
		$random = rand(0,4);

		echo '<h4>'.$a[$random].'</h4>';

	}

	else {

	}

?>
		<input type="text" name="ans" autofocus required/>
		<input type="submit" value="Submit" name="submit" required/>
	</form>
</center>

<?php	include('../design/footer.php');?>