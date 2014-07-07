<?php
$host = "localhost";
$username="root";
$password="";

mysql_connect("$host","$username","$password")or die("Server Failed");
mysql_select_db("agile_scrum")or die("Database connection Failed");

?>