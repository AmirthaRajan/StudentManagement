<?php
	$host="localhost"; 
	$username="root";
	$password="";
	$database="Aptitude";
	$connection = mysql_connect("$host", "$username", "$password") or die ("Unable to connect to server");
	mysql_select_db("$database") or die ("Unable to select database");
	if(mysql_query("Select * from students where username='".$_POST['username']."' and password = '".$_POST['password']."'"))
	{
	$sql = "TRUNCATE TABLE questions";
	mysql_query($sql);
	$sql1 = "TRUNCATE TABLE questions1";
	mysql_query($sql1);
	$sql2 = "TRUNCATE TABLE questions2";
	mysql_query($sql2);
	$sql3 = "TRUNCATE TABLE questions3";
	mysql_query($sql3);
	echo "Table Cleared";
	echo "<br/>";
	echo "Do you want to insert questions into table";
	echo "<br/>";
	echo "<form action='insert.php'>
	<input type='submit' value='Insert'>
	</form>";
	echo "<form action='index1.php'>
		<label>Home</label>
		<input type='submit' value='Back'>
		</form>";
	mysql_close($connection);
	}
	else
	{
	echo "<h3>Incorrect password</h3>";
	echo "<form action='index1.php'>
		<label>Home</label>
		<input type='submit' value='Back'>
		</form>";
		}
	
?>