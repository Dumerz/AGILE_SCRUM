<?php

	$sql = "SELECT * FROM `student.information.tbl` WHERE `student.number`='$usernumber'";
	$query = mysql_query($sql)or die(mysql_error());
	$x = mysql_fetch_array($query);
	echo"<br/><br/>";

	echo"	<table>
			<tr>	<td>Date of birth:	</td>
					<td>".$x['date.of.birth']. "</td>
			</tr>
			<tr>	<td>Place of birth: </td>
					<td>".$x['place.of.birth']. "</td>
			</tr>
			<tr>	<td>Gender: </td>
					<td>".$x['sex']. "</td>
			</tr>
			<tr>	<td>Civil Status: </td>
					<td>".$x['civil.status']. "</td>
			</tr>
			<tr>	<td>Citizenship: </td>
					<td>".$x['citizenship']. "</td>
			</tr>
			<tr>	<td>Height: </td>
					<td>".$x['height']. "</td>
			</tr>
			<tr>	<td>Weight: </td>
					<td>".$x['weight']. "</td>
			</tr>
			<tr>	<td>Address: </td>
					<td>".$x['address']. "</td>
			</tr>
			<tr>	<td>Zip Code: </td>
					<td>".$x['zip.code']. "</td>
			</tr>
			<tr>	<td>Guardian: </td>
					<td>".$x['guardian']. "</td>
			</tr>
			</table>";

		
?>