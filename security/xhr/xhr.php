<?php
	include('../../session/session_checker.php');
	include('../../database_connection/database_connection.php');

	header("Cache-Control: no-cache");
	header("Pragma: no-cache");
	header("Content-Type: text/xml");
	print "<?xml version='1.0' encoding='UTF-8'?>";

		$value = '';

		if(isset($_GET['username'])) { $value = $_GET['username']; }
		
		if(isset($_GET['username'])) {

			mysql_real_escape_string($value);
			$value = md5($value . 'Dumerz');
			$sql = "SELECT * FROM `users.information.tbl` WHERE `user.name` = '$value'";
			$result = mysql_query($sql);

			if (mysql_num_rows($result) > 0) { $res = '1'; }
			else { $res = '0';}

			print "<result> $res </result>";
		}
?>