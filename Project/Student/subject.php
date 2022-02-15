<?php
	error_reporting(E_ALL);
	ini_set('display_errors', true);
	include 'config.php';
	$code=serialize($_POST['code']);
	$name=serialize($_POST['name']);
	$credit=serialize($_POST['credit']);
	$sem = "sem".$_POST['sem'];
	$query="SELECT * FROM subject where department = '".$_POST['dept']."' and batch = '".$_POST['batch']."' and semester = '".$_POST['sem']."' ";
	$resource = mysqli_query($con,$query) or die(mysqli_error($con));
	$num=mysqli_num_rows($resource);
	if($num)
	{
	$sql = "UPDATE subject SET subcode = '$code' ,subname = '$name' , subcdt = '$credit' WHERE batch = '".$_POST['batch']."' AND department = '".$_POST['dept']."' and semester = '".$_POST['sem']."'";
	mysqli_query($con,$sql) or die(mysqli_error($con));
	}
	else
	{
	$sql="INSERT INTO subject (department,batch,semester,subcode,subname,subcdt) values ('".$_POST['dept']."','".$_POST['batch']."','".$_POST['sem']."','".$code."','".$name."','".$credit."' ) ";
	mysqli_query($con,$sql);	
	}
	
?>