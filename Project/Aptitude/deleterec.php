<?php
	$con=mysqli_connect("localhost","root","","Aptitude");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	if($_POST['id'] != "")
	{
		$sql="DELETE FROM questions WHERE id='$_POST[id]'";
		if (!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error($con));
		}
		$qry="ALTER TABLE questions DROP id ";
		if (!mysqli_query($con,$qry))
		{
			die('Error: ' . mysqli_error($con));
		}
		$stu="ALTER TABLE questions ADD id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";
		if (!mysqli_query($con,$stu))
		{
			die('Error: ' . mysqli_error($con));
		}
		
	}
	else
	{
	echo"<br/>The ID does not exist";
	}
	echo "<br/>You have successfully Deleted the question";
	mysqli_close($con);
	echo "<br/>Return to home Page";
	echo "<br/>";
	echo "<form action='index1.php'>
	<input type='submit' value='Home'>
	</form>";
	?>
