

<?php
$sql = "SELECT * FROM `student.information.tbl` WHERE `student.number`='11-00142'";
$query = mysql_query($sql)or die(mysql_error());
$x = mysql_fetch_array($query);

?>
