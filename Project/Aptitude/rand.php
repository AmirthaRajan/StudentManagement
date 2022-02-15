<?php 
	require_once('config.php');
	$conn = mysqli_connect("localhost","root","", "Aptitude");	

$query="SELECT * FROM questions ORDER BY RAND() LIMIT 35";
$result=$conn->query($query);   
	while($row = $result->fetch_assoc())
	{
	$image = mysqli_real_escape_string($conn,$row['image']);
	$image1 = mysqli_real_escape_string($conn,$row['image1']);
	$image2 = mysqli_real_escape_string($conn,$row['image2']);
	$image3 = mysqli_real_escape_string($conn,$row['image3']);
	$image4 = mysqli_real_escape_string($conn,$row['image4']);
	$qry="INSERT INTO `questions1` (question,image,answer1,image1,answer2,image2,answer3,image3,answer4,image4,answer) VALUES ('".$row['question']."','".$image."','".$row['answer1']."','".$image1."','".$row['answer2']."','".$image2."','".$row['answer3']."','".$image3."','".$row['answer4']."','".$image4."','".$row['answer']."')";
	$me=mysqli_query($conn,$qry);
	}
	
$query="SELECT * FROM questions ORDER BY RAND() LIMIT 35";
$result=$conn->query($query);   
	while($row = $result->fetch_assoc())
	{
	$image = mysqli_real_escape_string($conn,$row['image']);
	$image1 = mysqli_real_escape_string($conn,$row['image1']);
	$image2 = mysqli_real_escape_string($conn,$row['image2']);
	$image3 = mysqli_real_escape_string($conn,$row['image3']);
	$image4 = mysqli_real_escape_string($conn,$row['image4']);
	$qry="INSERT INTO `questions2` (question,image,answer1,image1,answer2,image2,answer3,image3,answer4,image4,answer) VALUES ('".$row['question']."','".$image."','".$row['answer1']."','".$image1."','".$row['answer2']."','".$image2."','".$row['answer3']."','".$image3."','".$row['answer4']."','".$image4."','".$row['answer']."')";
	$me=mysqli_query($conn,$qry);
	}
 
$query="SELECT * FROM questions ORDER BY RAND() LIMIT 35";
$result=$conn->query($query);   
	while($row = $result->fetch_assoc())
	{
	$image = mysqli_real_escape_string($conn,$row['image']);
	$image1 = mysqli_real_escape_string($conn,$row['image1']);
	$image2 = mysqli_real_escape_string($conn,$row['image2']);
	$image3 = mysqli_real_escape_string($conn,$row['image3']);
	$image4 = mysqli_real_escape_string($conn,$row['image4']);
	$qry="INSERT INTO `questions3` (question,image,answer1,image1,answer2,image2,answer3,image3,answer4,image4,answer) VALUES ('".$row['question']."','".$image."','".$row['answer1']."','".$image1."','".$row['answer2']."','".$image2."','".$row['answer3']."','".$image3."','".$row['answer4']."','".$image4."','".$row['answer']."')";
	$me=mysqli_query($conn,$qry);
	}
echo "</br><h2>You have successfully updated the questions</h2><br/><form action='index1.php'><input type='submit' value='Back'></form>";
?>