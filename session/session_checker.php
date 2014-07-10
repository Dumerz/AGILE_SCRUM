<?php

	class Session {

		function __construct() {

			$this->start();

		}

		protected function start() {

			session_start();
			$this->clientIdentifier();
		
		}

		protected function clientIdentifier() {

			$clientReg = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
			$this->is_newClient($clientReg);
			$this->is_errorClient($clientReg);
		
		}

		protected function is_newClient($entry) {

			if (empty($_SESSION['client'])) {

					session_regenerate_id( );
					$_SESSION['client'] = $entry;
				        header("Location:http://localhost/AGILE_SCRUM/index.php");
				}

		}

		protected function is_errorClient($entry) {

			if (strcmp($_SESSION['client'], $entry) !== 0) {

				session_regenerate_id( );
				$_SESSION = array( );
				$_SESSION['client'] = $entry;
				    header("Location:http://localhost/AGILE_SCRUM/security/login.php");

			}

			else {

			}

		}

		protected function update_client_details( $en_account ) {
			$account = mysql_real_escape_string($en_account);
			$sql = "UPDATE `users.information.tbl` SET `user.account` = '$account', `user.date.exp` = ADDDATE(CURDATE(), INTERVAL 3 MONTH) WHERE `user.number` = '{$_SESSION['usernumber']}'";
			$query = mysql_query($sql)or die(mysql_error());

		}

		public function client_logout( ) {
			$this->update_client_details( 'OFFLINE' );
        	unset($_SESSION['usernumber']);
        	unset($_SESSION['username']);
        	unset($_SESSION['usertype']);
			header("Location:http://localhost/AGILE_SCRUM/security/login.php");
		}

		public function is_student( ) {

			if ($_SESSION['usertype'] == 'Student') { return true;}
			else { return false; }

		}

		public function is_faculty( ) {

			if ($_SESSION['usertype'] == 'Faculty') { return true;}
			else { return false; }

		}

		public function is_college_admin( ) {

			if ($_SESSION['usertype'] == 'College Admin') { return true;}
			else { return false; }

		}

		public function is_club_admin( ) {

			if ($_SESSION['usertype'] == 'Club Admin') { return true;}
			else { return false; }

		}

		public function is_system_admin( ) {

			if ($_SESSION['usertype'] == 'System Admin') { return true;}
			else { return false; }

		}

		public function user_type_redirect( ) {

			if($this->is_student()) { header("Location:http://localhost/AGILE_SCRUM/stud_profile/stud_profile.php?basic"); }
			
			else if($this->is_faculty()) { header("Location:http://localhost/AGILE_SCRUM/faculty/faculty_profile.php?basic"); }

			else if($this->is_college_admin()) { header("Location:http://localhost/AGILE_SCRUM/admin/college/profile.php"); }

			else if($this->is_club_admin()) { header("Location:http://localhost/AGILE_SCRUM/admin/club/profile.php"); }

			else if($this->is_system_admin()) { header("Location:http://localhost/AGILE_SCRUM/admin/system/profile.php"); }

			else { header("Location:http://localhost/AGILE_SCRUM/index.php");}
		}

	}

	$checker = new Session();

?>