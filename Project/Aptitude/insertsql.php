<?php
	
	error_reporting(E_ALL);
	ini_set('display_errors', true);
	$con=mysqli_connect("localhost","root","","Aptitude") or die("Error " . mysqli_error($con));
	
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
	if((isset($_FILES['image'])) && (isset($_FILES['image1'])) && (isset($_FILES['image2'])) && (isset($_FILES['image3'])) && (isset($_FILES['image4'])) )
	{
	$image = @mysqli_real_escape_string($con,fread (fopen ($_FILES['image']['tmp_name'], "r"), filesize($_FILES['image']['tmp_name'])));
	$image1 = @mysqli_real_escape_string($con,fread (fopen ($_FILES['image1']['tmp_name'], "r"), filesize($_FILES['image1']['tmp_name'])));
	$image2 = @mysqli_real_escape_string($con,fread (fopen ($_FILES['image2']['tmp_name'], "r"), filesize($_FILES['image2']['tmp_name'])));
	$image3 = @mysqli_real_escape_string($con,fread (fopen ($_FILES['image3']['tmp_name'], "r"), filesize($_FILES['image3']['tmp_name'])));
	$image4 = @mysqli_real_escape_string($con,fread (fopen ($_FILES['image4']['tmp_name'], "r"), filesize($_FILES['image4']['tmp_name'])));
	$question = mysqli_real_escape_string($con,$_POST['question']);
	$answer1 = mysqli_real_escape_string($con,$_POST['answer1']);
	$answer2 = mysqli_real_escape_string($con,$_POST['answer2']);
	$answer3 = mysqli_real_escape_string($con,$_POST['answer3']);
	$answer4 = mysqli_real_escape_string($con,$_POST['answer4']);
	$sql="INSERT INTO questions VALUES ('','$question','$image','$answer1','$image1','$answer2','$image2','$answer3','$image3','$answer4','$image4','$_POST[answer]')";
	$query=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
	}
	echo "1 record added";
	echo "<br/>";
	echo "Do you want to add another question";
	echo "<br/>";
	echo "<a href=insert.php>Back</a>";
	echo "<br/>";
	echo "Return to home Page";
	echo "<br/>";
	echo "<form action='index1.php'>
		<input type='submit' value='Home'>
		</form>";

?>