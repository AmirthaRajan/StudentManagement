<?php
	error_reporting(E_ALL);
	ini_set('display_errors', true);
	ini_set('max_execution_time', 300);
	include 'config.php';
@	$rollno=$_POST['rollno'];
	$dt=$_POST['date'];
	$dept=$_POST['dept'];
	$batch=$_POST['batch'];
	$sec=$_POST['section'];
	$sem="sem".$_POST['sem'];
	$semester=$_POST['sem'];
	
	
	$query = "SELECT DISTINCT $sem FROM attendance WHERE batch = $batch and department = '$dept' and section = '$sec' ";
	$result = mysqli_query($con,$query) or die(mysqli_error($con));
	$keys=0;
	while($array= mysqli_fetch_array($result))
	{
	$POST1=unserialize($array[$sem]);
	$key = array_search($dt,$POST1);
		if($key != null)
			break;
	}
	if( $key != null)
	{
	$sql2 = "SELECT * FROM attendance WHERE batch = $batch and department = '$dept' and section = '$sec' ";
	$rst2 = mysqli_query($con,$sql2) or die(mysqli_error($con));
	$cont = mysqli_num_rows($rst2);
	$POST2=mysqli_fetch_array($rst2);
	$take=unserialize($POST2[$sem]);
	$take[$key]=$dt;
	$sql2 = "SELECT * FROM attendance WHERE batch = $batch and department = '$dept' and section = '$sec' ";
	$rst2 = mysqli_query($con,$sql2) or die(mysqli_error($con));
	
	while($POST2=mysqli_fetch_array($rst2))
		  {
		$sql3 = "SELECT * FROM attendance WHERE rollno = '".$POST2['rollno']."' and batch = $batch and department = '$dept' and section = '$sec' ";
		$rst3 = mysqli_query($con,$sql3) or die(mysqli_error($con));
		$POST3 = mysqli_fetch_array($rst3);
		$take=unserialize($POST3[$sem]);
		$take[$key]=$dt;
		$insert=serialize($take);
		$sql4="UPDATE attendance SET $sem = '$insert' WHERE rollno = '".$POST2['rollno']."' ";
		//echo "<br/>".$sql4."<br/>";
		mysqli_query($con,$sql4) or die(mysqli_error($con));
		  }
	
	for($i=0;$i<$_POST['count'];$i++)
	{
		$sql5 = "SELECT * FROM attendance WHERE rollno = '".$rollno[$i]."' and batch = $batch and department = '$dept' and section = '$sec' ";
		$rst5 = mysqli_query($con,$sql5) or die(mysqli_error($con));
		$POST5 = mysqli_fetch_array($rst5);
		$take=unserialize($POST5[$sem]);
		$take[$key]='a';
		$insert=serialize($take);
		$sql6="UPDATE attendance SET $sem = '$insert' WHERE rollno = '".$rollno[$i]."' ";
		//echo "<br/>".$sql6."<br/>";
		mysqli_query($con,$sql6) or die(mysqli_error($con));
	}
		$sql10 = "SELECT * FROM attendance WHERE rollno = 'admin' ";
		$rst10 = mysqli_query($con,$sql10) or die(mysqli_error($con));
		$POST10 = mysqli_fetch_array($rst10);
		$take=unserialize($POST10[$sem]);
		$take[$key]=$dt;
		$insert=serialize($take);
		$sql10="UPDATE attendance SET $sem = '$insert' WHERE rollno = 'admin' ";
		echo "<br/>".$sql10."<br/>";
		mysqli_query($con,$sql10) or die(mysqli_error($con));
	}
	else
	{

	$sql2 = "SELECT * FROM attendance WHERE batch = $batch and department = '$dept' and section = '$sec' ";
	$rst2 = mysqli_query($con,$sql2) or die(mysqli_error($con));
	$cont = mysqli_num_rows($rst2);
	$POST2=mysqli_fetch_array($rst2);
	$take=unserialize($POST2[$sem]);
	/*
	$key=key($take);
	if($key == null)
	{$key=0;}
	$key=$key+1;
	*/
	end($take);
	$key = key($take);
	reset($take);
	$take[$key+1]=$dt;
	$sql3 = "SELECT * FROM attendance WHERE batch = $batch and department = '$dept' and section = '$sec' ";
	$rst3 = mysqli_query($con,$sql3) or die(mysqli_error($con));
	
	while($POST3=mysqli_fetch_array($rst3))
		  {
		$sql4 = "SELECT * FROM attendance WHERE rollno = '".$POST3['rollno']."' and batch = $batch and department = '$dept' and section = '$sec' ";
		$rst4 = mysqli_query($con,$sql4) or die(mysqli_error($con));
		$POST4 = mysqli_fetch_array($rst4);
		$take=unserialize($POST4[$sem]);
		$take[$key+1]=$dt;
		$insert=serialize($take);
		$sql5="UPDATE attendance SET $sem = '$insert' WHERE rollno = '".$POST3['rollno']."' ";
		mysqli_query($con,$sql5) or die(mysqli_error($con));
		  }
	
	for($i=0;$i<$_POST['count'];$i++)
	{
		$sql6 = "SELECT * FROM attendance WHERE rollno = '".$rollno[$i]."' and batch = $batch and department = '$dept' and section = '$sec' ";
		$rst6 = mysqli_query($con,$sql6) or die(mysqli_error($con));
		$POST6 = mysqli_fetch_array($rst6);
		$take=unserialize($POST6[$sem]);
		$take[$key+1]='a';
		$insert=serialize($take);
		$sql7="UPDATE attendance SET $sem = '$insert' WHERE rollno = '".$rollno[$i]."' ";
		mysqli_query($con,$sql7) or die(mysqli_error($con));
	}
	}
	
?>