<?php
	include('../../session/session_checker.php');
	include('../../database_connection/database_connection.php');

	header("Cache-Control: no-cache");
	header("Pragma: no-cache");
	header("Content-Type: text/xml");
	print "<?xml version='1.0' encoding='UTF-8'?>";

		$email = '';
		$table = '';

		if(isset($_GET['email'])) { $email = $_GET['email']; }

		if(isset($_GET['email'])) {

			mysql_real_escape_string($email);
			if ($_SESSION['usertype'] == 'Student') { $table = 'student.information.tbl';}
            if ($_SESSION['usertype'] == 'Faculty') { $table =  'faculty.information.tbl';}

            $sql = "SELECT * FROM `$table` WHERE `email`='$email'";
    		$result = mysql_query($sql)or die(mysql_error());

    		if (mysql_num_rows($result) > 0) { $res = '1'; }
			else { $res = '0';}

			print "<result> $res </result>";

		}

?>