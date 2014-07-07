<?php

	include('session/session_checker.php');
	include('design/header.php');
	include('database_connection/database_connection.php');

	if(isset($_SESSION['usernumber'])) { $checker->user_type_redirect(); }

?>

	<center>
		<img src="img/CCS LOGO.jpg" style="margin-top:5em;"/>
		<h3>College of Computer Studies</h3>
		<h4>Information System</h4>
		<a href="http://localhost/AGILE_SCRUM/security/login.php"><button>Log In</button></a>
	</center>

<?php

	include('design/footer.php');

?>