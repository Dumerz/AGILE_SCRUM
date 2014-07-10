<?php
$usernumber = $_SESSION['usernumber'];
$sql = "SELECT * FROM `student.information.tbl` WHERE `student.number`='$usernumber'";
$query = mysql_query($sql)or die(mysql_error());
$x = mysql_fetch_array($query);

		echo "<table>
		<tr><img src=\"".$x['picture']."\" width='90'; height='90'; align='left';/></tr>
		<tr>   
		<td>Student Number: ".$x['student.number']."</td>
		</tr>
		<tr>
		<td>Name: ".$x['student.lastname']. ", " .$x['student.firstname']. " " .$x['student.middlename']."</td>
		</tr>
		<tr>
		<td>Address: ".$x['address']."</td>
		</tr>
		<tr>
		<td>Email Address: ".$x['email']."</td>
		</tr>
		</table>";    

echo "<hr/>";

?>