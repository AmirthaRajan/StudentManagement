<?php
	$con=mysqli_connect("localhost","root","","aptitude");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$sql="INSERT INTO students (username,password,rollno,department,batch,section) VALUES ('$_POST[username]','$_POST[password]','$_POST[rollno]','$_POST[department]','$_POST[batch]','$_POST[section]')";
	if (!mysqli_query($con,$sql))
	{
		die('Error: ' . mysqli_error($con));
	}
	
	echo "You have successfully Registered";
	echo "<br/>";
	echo "Do you want to register another record";
	echo "<br/>";
	echo "<a href=register.php>Back</a>";
	
	mysqli_close($con);
?>
