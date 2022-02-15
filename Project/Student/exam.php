<?php
	error_reporting(E_ALL);
	ini_set('display_errors', true);
	include 'config.php';
	$mark=$_POST['mark'];
	$rollno=$_POST['rollno'];
	$sem=$_POST['sem'];
	$batch=$_POST['batch'];
	$dept=$_POST['dept'];
	if($_POST['startrow']>=25)
	$starow=$_POST['startrow']-25;
	else
	$starow=$_POST['startrow'];
	$sbj=$_POST['sbj'];
	$test=$_POST['test'];
	$count=$_POST['count'];
	$query = "SELECT DISTINCT rollno,$test FROM semester$sem WHERE batch = $batch and department = '$dept' LIMIT $starow,$count";
	$result = mysqli_query($con,$query) or die(mysqli_error($con));
	$row= mysqli_fetch_array($result);
	$subqry = "SELECT subname FROM subject WHERE batch = $batch and department = '$dept' and semester = '$sem' ";
	$subres = mysqli_query($con,$subqry) or die(mysqli_error($con));
	$subrow= mysqli_fetch_array($subres);
	$rows=unserialize($subrow['subname']);
	$key = array_search($sbj,$rows);
	$qry = "SELECT DISTINCT rollno,$test FROM semester$sem WHERE batch = $batch and department = '$dept' LIMIT $starow,$count";
	$rst = mysqli_query($con,$qry) or die(mysqli_error($con));
	$cont = mysqli_num_rows($rst);
	$i=0;
    while($get= mysqli_fetch_array($rst))
    { 
	$take=unserialize($get[$test]);
	$take[$key]=$mark[$i];
	$insert=serialize($take);
	$sql="UPDATE semester$sem SET $test = '$insert' WHERE rollno = '$rollno[$i]' ";
	mysqli_query($con,$sql) or die(mysqli_error($con));
	$i++;
	}
?>