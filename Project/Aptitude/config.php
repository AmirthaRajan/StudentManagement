<?php
	
	
	$con=mysql_connect("localhost","root","Pitadmin@ithod") or die("Failed to connect to MySQL: " . mysql_error());
	$db=mysql_select_db("Aptitude",$con) or die("Failed to connect to MySQL: " . mysql_error());
	
?>