<?php	include('../session/session_checker.php');
		include('../design/header.php');
		include('../database_connection/database_connection.php');

	if(isset($_SESSION['usernumber'])) {

    class Setting {

        function __construct() {

            $this->is_submitted();

        }

        const KEY = 'Dumerz';

        private function is_submitted( ) {

            if(isset($_POST['submit'])) {

                $data = array( );

                    $data['username'] = $this->is_valid_username($_POST['username']);
                    $data['password'] = $this->is_valid_pass($_POST['password']);
                    $data['email'] = $this->is_valid_email($_POST['email']);

                }

        }


        protected function is_valid_username( $entry ) {

            $result = '';
            $pattern = '/^[a-z0-9_]{6,20}$/';

                if (preg_match($pattern, $entry)) {
                    $name = md5($entry . Setting::KEY); 
                        $sql = "SELECT * FROM `users.information.tbl` WHERE `user.name`='$name'";
                            $query = mysql_query($sql)or die(mysql_error());
                            $check = mysql_num_rows($query);

                        if ($check > 0) { echo 'Username exist';}
                        else { $result = $entry; }
                }

            return $result;

        }

        protected function is_valid_pass( $entry ) {

            $result = '';
            $pattern = '/^[A-z0-9_]{6,20}$/';

                if (preg_match($pattern, $entry)) { $result = $entry; }

            return $result;

        }

        protected function is_valid_email( $entry ) {

            $result = '';
            $pattern = '/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/';

                if (preg_match($pattern, $entry)) { $result = $entry; }

            return $result;

        }

        public function print_input( $entry ) {

            if (isset($_POST[$entry])) { echo $_POST[$entry]; }
        }

    }

    $setting = new Setting();

?>
  <form method="POST" action="setting.php">
      <fieldset style="margin:0 auto; width:50%"> 
        <legend>Account Settings</legend>
        	<fieldset>
        		<legend>Username Settings</legend>
		        <table>
		        	<tr><td><label for="username"> New Username: </label></td> <td><input type="text" name="username" id="username" value="<?php $setting->print_input('username');?>" required></td>
                        <td><span id="res_username"> </span></td>
                    </tr>
		        </table>
        	</fieldset>
        	<fieldset>
        		<legend>Password Setttings</legend>
		        <table>
		        	<tr><td><label for="password"> Password: </label></td> <td><input type="password" name="password" id="password" value="<?php $setting->print_input('password');?>" required></td>
                        <td id="res_password"></td>
                    </tr>
		        	<tr><td><label for="rt_password"> Re-type Password: </label></td> <td><input type="password" name="rt_password" id="rt_password" value="<?php $setting->print_input('rt_password');?>" required></td>
                        <td id="res_rt_password"></td>
                    </tr>
		        </table>
        	</fieldset>
        	<fieldset>
        		<legend>Email Setttings</legend>
		        <table>
        			<tr><td><label for="email"> Email Address: </label></td> <td><input type="email" name="email" id="email" value="<?php $setting->print_input('email');?>" required></td>
                        <td id="res_email"></td>
                    </tr>
		        </table>
        	</fieldset>
        	<fieldset>
        		<legend>Image Settings</legend>
		        <table>
        			<tr><td><label for="image"> Profile Picture </label></td> <td><input type="file" name="image" id="image" accept="" required></td>
                        <td id="res_image"></td>
                    </tr>
		        </table>
        	</fieldset>
        	<fieldset>
		        <table>
        			<tr><td><input type="submit" name="submit" id="submit" value="Save Changes"required></td></tr>
		        </table>
        	</fieldset>
        </table>
      </fieldset>
    </form>

    <script type="text/javascript" src="http://localhost/AGILE_SCRUM/security/security.js"></script>

<?php

    if(isset($_POST['submit'])) {
?>

    <script type="text/javascript">
        window.addEventListener("load", handler, false);
    </script>

<?php        
    }

	}

	else {
		header("Location:http://localhost/AGILE_SCRUM/security/login.php");
	}

?>