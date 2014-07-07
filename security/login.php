<?php	include('../session/session_checker.php');
		include('../design/header.php');
		include('../database_connection/database_connection.php');	?>

<?php

	class Login extends Session {

		function __construct( ) {

			$this->is_logged_in( );

		}

		const KEY = 'Dumerz';

		private function is_submitted( ) {

			if(isset($_POST['submit']))	{

				$data = array( );

					$data['username'] = $this->is_valid_username($_POST['username']);
					$data['password'] = $this->is_valid_pass($_POST['password']);
					$data['userType'] = $this->is_valid_userType($_POST['userType']);

					$this->query_account($data['username'],$data['password'],$data['userType']);

				}

		}

		protected function is_logged_in() {

			if (isset($_SESSION['username'])) {	header("Location:../index.php"); }

			else { $this->is_submitted( ); }

		}

		protected function is_valid_username( $entry ) {

			$result = '';
			$pattern = '/^[a-z0-9_]{6,20}$/';

				if (preg_match($pattern, $entry)) {	$result = $entry; }

			//echo 'USERNAME : (MD5) ' . md5($result . Login::KEY) . '<br/>';
			return md5($result . Login::KEY);

		}

		protected function is_valid_pass( $entry ) {

			$result = '';
			$pattern = '/^[A-z0-9_]{6,20}$/';

				if (preg_match($pattern, $entry)) { $result = $entry; }

			//echo 'PASSWORD : (MD5) ' . md5($result . Login::KEY);
			return md5($result . Login::KEY);

		}

		protected function is_valid_userType( $entry ) {

			$result = '';
			$userType = array('Student','Faculty','ClubAdmin','CollegeAdmin','SystemAdmin');

				foreach ($userType as $key => $value) {	if ($value == $entry) { $result = $value; } }

			return $result;

		}

		protected function query_account( $user, $pass, $type ) {

		    $sql = "SELECT * FROM `users.information.tbl` WHERE `user.name`='$user'";
		    $query = mysql_query($sql)or die(mysql_error());
		    $check = mysql_num_rows($query);

		        if ($check > 0) { $row = mysql_fetch_array($query);

		            if ($row['user.password'] == $pass && $row['user.type'] == $type) {

			            if ($row['user.status'] == 'ACTIVATED') {
			            	$_SESSION['usernumber'] = $row['user.number'];
			            	$_SESSION['username'] = $row['user.name'];
			            	$_SESSION['usertype'] = $row['user.type'];
			            	$this->list_client_details('ONLINE', $_SERVER['HTTP_USER_AGENT'], $_SERVER['REMOTE_ADDR']);
			            	$this->user_type_redirect();
			            	
			            }

			            else {

		            	$this->error_log("Activate your account <a href=\"activate.php\">here</a>");  

			            }
		            }

		            else {

		            	$this->error_log("Incorrect username and password");
		            }    
            	}

            	else {

		             $this->error_log("Account is not Existing");
            	}

		}

		public function print_input( $entry ) {

			if (isset($_POST[$entry])) { echo $_POST[$entry]; }
		}

		public function error_log( $message ) {

			echo '<center><h4>'. $message .'</h4></center>';
		}

	}

	$login = new Login();

?>

	<meta content="refresh">
	<form method="POST" action="login.php">
			<fieldset style="margin:0 auto; width:30%"> 
				<legend>Login Form</legend> 
					<p><label for="username"> Username: <input type="text" name="username" id="username" value="<?php $login->print_input('username');?>" required autofocus></label></p>
					<p><label for="password"> Password: <input type="password" name="password" id="password" required></label></p>
					<p><label for="userType"> Login As: 
						<select name="userType" required>
							<option value ="Student" selected>Student</option>
							<option value ="Faculty">Faculty</option>
							<option value ="CollegeAdmin">College Admin</option>
							<option value ="ClubAdmin">Club Admin</option>
							<option value ="SystemAdmin">System Admin</option>
						</select>
					</label></p>
					<p><input type="submit" name="submit" id="submit" required></p>
			</fieldset>
	</form>

<?php	include('../design/footer.php');?>