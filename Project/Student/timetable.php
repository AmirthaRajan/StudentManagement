<?php
	error_reporting(E_ALL);
	ini_set('display_errors', true);
	$ary=array();
	$array=serialize($_POST['sbj']);
	include 'config.php';
	$query="SELECT * FROM timetable where department = '".$_POST['dept']."' and batch = '".$_POST['batch']."' and section = '".$_POST['section']."' and semester = '".$_POST['sem']."' ";
	$resource = mysqli_query($con,$query) or die(mysqli_error($con));
	$num=mysqli_num_rows($resource);
	if($num)
	{
		echo "<span style='color:red;align:center;'><b>NOTICE:<br/>A TimeTable already exists and now it has been replaced with this new TimeTable </b></span>"; 
		$sql= "UPDATE timetable SET `timetable` = '$array' WHERE department = '".$_POST['dept']."' and batch = '".$_POST['batch']."' and section = '".$_POST['section']."' and semester = '".$_POST['sem']."' ";
		mysqli_query($con,$sql);
	}
	else
	{
	$days = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri');
	$day=serialize($days);
	echo $day;
	$sql="INSERT INTO timetable (days,department,batch,section,semester,timetable) values ('$day','".$_POST['dept']."','".$_POST['batch']."','".$_POST['section']."','".$_POST['sem']."','".$array."' ) ";
	mysqli_query($con,$sql);
	echo "<div><p align='center'><b>Successfully Added</b></p></div>";
	}

?>