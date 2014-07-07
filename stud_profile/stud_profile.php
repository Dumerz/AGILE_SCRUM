<?php	include('../session/session_checker.php');
		include('../design/header.php');
		include('../database_connection/database_connection.php');

		if (!$checker->is_student()) { $checker->user_type_redirect(); }

?>
	
<?php	include('head_prof.php');
		include('tabs.php');
			
				if (isset($_GET['basic']))
				{
					include('basic_info.php');
				}
				else if (isset($_GET['grades']))
				{
					include('grades.php');
				}
				else if (isset($_GET['subjects']))
				{
					include('subjects.php');
				}
				else if (isset($_GET['deficiencies']))
				{
					include('deficiencies.php');
				}
				else if (isset($_GET['club']))
				{
					include('club.php');
				}
				else if (isset($_GET['update']))
				{
					include('update_account.php');
				}
				else if (isset($_GET['logout']))
				{
					$checker->client_logout();
				}
					
?>
<?php	include('../design/footer.php');?>