<?php
	require_once('config.php');
	$con=mysqli_connect("localhost","root","","Aptitude");
if (mysql_error())
{
	echo "Failed to connect to MySQL: " . mysql_connect_error();
}
else
{
	if(isset($_POST['id']) && ($_POST['id'] != NULL))
	{
		$id="DELETE FROM students WHERE id='$_POST[id]'";
		$sql=mysql_query($id) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $id  . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
			if($id)
			{
				if ($sql)
				{
				echo "You have successfully removed the student from the record";
				}
				else
				{
				die('Error: ' . mysql_error());
				}
	
			}
		$qry="ALTER TABLE students DROP id ";
		if (!mysqli_query($con,$qry))
		{
			die('Error: ' . mysqli_error($con));
		}
		$stu="ALTER TABLE students ADD id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";
		if (!mysqli_query($con,$stu))
		{
			die('Error: ' . mysqli_error($con));
		}
		
	}	
	elseif(isset($_POST['rollno']) && ($_POST['rollno'] != NULL))
	{
		$no="DELETE FROM students WHERE rollno='$_POST[rollno]'";
		$sq1=mysql_query($no) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $no  . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		if($no)
		{
			if ($sq1)
			{
				echo "You have successfully removed the student from the record";
			}
			else
			{
				die('Error: ' . mysql_error());
			}
			
		}
		   $qry="ALTER TABLE students DROP id ";
		if (!mysqli_query($con,$qry))
		{
			die('Error: ' . mysqli_error($con));
		}
		   $stu="ALTER TABLE students ADD id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";
		if (!mysqli_query($con,$stu))
		{
			die('Error: ' . mysqli_error($con));
		}

	}
	else
	{
		echo "Student Not Found";
	}
	mysqli_close($con);
}
?>
<html>
<body><br/>
<a href="securedpage.php"><img src="back_button.gif"/></a>
</body>
</html>