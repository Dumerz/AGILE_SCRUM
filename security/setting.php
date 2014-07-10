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

        }

        public function is_valid_username( $entry ) {

            $pattern = '/^[A-z0-9_]{6,20}$/';
                if (preg_match($pattern, $entry)) {
                $pattern = '/[A-Z]/';
                    if (!preg_match($pattern, $entry)) { 
                        $pattern = '/[0-9]/';
                        if (preg_match($pattern, $entry)) { 
                            $name = md5($entry . Setting::KEY); 
                                $sql = "SELECT * FROM `users.information.tbl` WHERE `user.name`='$name'";
                                    $query = mysql_query($sql)or die(mysql_error());
                                    $check = mysql_num_rows($query);

                            if ($check > 0) { echo '<span class="error-res">Username already exist</spa>';}
                            else {
                                $num = $_SESSION['usernumber'];
                                $sql = "UPDATE `users.information.tbl` SET `user.name` = '$name' WHERE `user.number` = '$num'";
                                mysql_query($sql)or die(mysql_error());
                                echo '<span class="valid-res">Username is successfully changed</span>'; 
                                }
                        }
                        else { echo '<span class="error-res">Username must contains numbers</span>'; }
                    }
                    else { echo '<span class="error-res">Username must not contains capital letters</span>'; }
                }

                elseif ($entry=="") {
 
                }

                else {

                    echo '<span class="error-res">Username is invalid</span>';
                }

        }

        public function is_valid_pass( $entry ) {

            $pattern = '/^[A-z0-9_]{6,20}$/';
                if (preg_match($pattern, $entry)) { //
                    $pattern = '/[A-Z]/';
                        if (preg_match($pattern, $entry)) {
                            $pattern = '/[0-9]/';
                                if (preg_match($pattern, $entry)) {
                                    $name = md5($entry . Setting::KEY);
                                    $old_password = $_POST['old_password'];
                                    $old_password = md5($old_password . Setting::KEY);
                                    $num = $_SESSION['usernumber'];
                                    $sql = "SELECT * FROM `users.information.tbl` WHERE `user.number`='$num' AND `user.password`='$old_password'";
                                    $query = mysql_query($sql)or die(mysql_error());
                                    $check = mysql_num_rows($query);
                                        if ($check > 0) {
                                            $num = $_SESSION['usernumber'];
                                            $sql = "UPDATE `users.information.tbl` SET `user.password` = '$name' WHERE `user.number` = '$num'";
                                            mysql_query($sql)or die(mysql_error());
                                            echo '<span class="valid-res">Password is successfully changed</span>';
                                        }
                                        else { echo '<span class="error-res">Current password invalid</span>'; }
                                }
                                else { echo '<span class="error-res">Password must contain numbers</span>'; }
                        }

                        else { echo '<span class="error-res">Password must contain capital letters</span>'; }
                }

                elseif ($entry=="") { }
                else { echo '<span class="error-res">Username is invalid</span>';}


        }

        public function is_valid_email( $entry ) {

            $pattern = '/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/';
                if (preg_match($pattern, $entry)) {
                    $table = '';
                    $num = $_SESSION['usernumber'];
                        if ($_SESSION['usertype'] == 'Student') { $table = 'student.information.tbl';}
                        if ($_SESSION['usertype'] == 'Faculty') { $table =  'faculty.information.tbl';}
                            $sql = "SELECT * FROM `$table` WHERE `email`='$entry'";
                            $result = mysql_query($sql)or die(mysql_error());
                                if (mysql_num_rows($result) > 0) { echo '<span class="error-res">Email address already exist</span>'; }
                                else { 
                                    $sql = "UPDATE `student.information.tbl` SET `email` = '$entry' WHERE `student.number` = '$num'";
                                    mysql_query($sql)or die(mysql_error());  
                                    echo '<span class="valid-res">Email address is successfully changed</span>';
                                }
                }
                elseif ($entry=="") { }
                else { echo '<span class="error-res">Email Address is not valid</span>'; }


        }

        public function print_input( $entry ) {

            if (isset($_POST[$entry])) { echo $_POST[$entry]; }
        }

        public function class_user( ) {
            if ($_SESSION['usertype'] == 'Student') { return 'student.information.tbl';}
            if ($_SESSION['usertype'] == 'Faculty') { return 'Faculty';}
        }

    }

    $setting = new Setting();

    $usernumber = $_SESSION['usernumber'];

    $table = $setting->class_user();
    $sql = "SELECT * FROM `$table` WHERE `student.number`='$usernumber'";
    $query = mysql_query($sql)or die(mysql_error());
    $x = mysql_fetch_array($query);

    echo "<table>
        <tr><img src=\"".$x['picture']."\" width='90'; height='90'; align='left';/></tr>
        <tr><td>User Number: ".$x['student.number']."</td></tr>
        <tr><td>Name: ".$x['student.lastname']. ", " .$x['student.firstname']. " " .$x['student.middlename']."</td></tr>
        <tr><td>Address: ".$x['address']."</td></tr>
        <tr><td>Email Address: ".$x['email']."</td></tr>
        </table>";    

    echo "<hr/>";

?>
  <form method="POST" action="setting.php">
      <fieldset style="margin:0 auto; width:50%"> 
        <legend>Account Settings</legend>
        	<fieldset>
        		<legend>Username Settings</legend>
		        <table>
		        	<tr><td><label for="username"> New Username: </label></td> <td><input type="text" name="username" id="username" value="<?php $setting->print_input('username');?>"></td>
                        <td id="res_username"><?php if(isset($_POST['username'])) {$setting->is_valid_username($_POST['username']);} ?></td>
                    </tr>
		        </table>
        	</fieldset>
        	<fieldset>
        		<legend>Password Setttings</legend>
		        <table>
                    <tr><td><label for="old_password"> Current Password: </label></td> <td><input type="password" name="old_password" id="old_password" value=""></td>
                        <td id="res_old_password"></td>
                    </tr>
		        	<tr><td><label for="password"> Password: </label></td> <td><input type="password" name="password" id="password" value=""></td>
                        <td id="res_password"><?php if(isset($_POST['password'])) {$setting->is_valid_pass($_POST['password']);} ?></td>
                    </tr>
		        </table>
        	</fieldset>
        	<fieldset>
        		<legend>Email Setttings</legend>
		        <table>
        			<tr><td><label for="email"> Email Address: </label></td> <td><input type="email" name="email" id="email" value="<?php $setting->print_input('email');?>"></td>
                        <td id="res_email"><?php if(isset($_POST['email'])) {$setting->is_valid_email($_POST['email']);} ?></td>
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
	}

	else {
		header("Location:http://localhost/AGILE_SCRUM/security/login.php");
	}

?>