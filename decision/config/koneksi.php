<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "decision";

// Koneksi dan memilih database di server
$con = mysql_connect($server,$username,$password) or die("Connection Failed");
mysql_select_db($database, $con) or die("Can't Access the Database");
?>
