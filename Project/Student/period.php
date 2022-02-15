<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>
View Attendance
</title>
<style>
td
{
text-align:center;
vertical-align:middle;
}
</style>
</head>
<?php
	include 'config.php';
	ini_set('max_execution_time', 3000);
	error_reporting(E_ALL ^ E_NOTICE);
	ini_set('display_errors', true);
?>
<body>
<div id="txtHint">
<form name="form" id="form">
Department:
<select name="dept" id="dept" label="Department" >
<?php
	$res="SELECT DISTINCT department FROM studinfo ";
	$result=mysqli_query($con,$res) or die(mysqli_error($con));
	
	if (isset($_GET['dept']))
	{
		echo "<option value=".$_GET['dept']." selected>".$_GET['dept']."</option> ";
	}
	else
	{
		echo "<option ></option>";
	}
	while($row = mysqli_fetch_assoc($result))
	{
		echo "<option value=".$row['department']." >".$row['department']."</option> ";
	}
	?>
</select>
Batch:
<select name="batch" id="batch" label="Batch">
<?php
	
	if(!empty($_GET['dept']))
	{
		$res="SELECT DISTINCT batch FROM studinfo WHERE department = '".$_GET['dept']."' ";
		$result=mysqli_query($con,$res) or die(mysqli_error($con));
		
		if (isset($_GET['batch']))
		{
			echo "<option value=".$_GET['batch']." selected>".$_GET['batch']."</option> ";
		}
		else
		{
			echo " <option ></option>";
		}
		while($row = mysqli_fetch_assoc($result))
		{
			echo "<option value=".$row['batch']." >".$row['batch']."</option> ";
		}
	}
	?>
</select>
Section:
<select name="section" id="section" label="section">
<?php
	
	if(!empty($_GET['batch']))
	{
		$res="SELECT DISTINCT section FROM studinfo WHERE department = '".$_GET['dept']."' and batch = '".$_GET['batch']."'";
		$result=mysqli_query($con,$res) or die(mysqli_error($con));
		
		if (isset($_GET['section']))
		{
			echo "<option value=".$_GET['section']." selected>".$_GET['section']."</option> ";
		}
		else
		{
			echo " <option ></option>";
		}
		while($row = mysqli_fetch_assoc($result))
		{
			echo "<option value=".$row['section']." >".$row['section']."</option> ";
		}
	}
	?>
</select>
Semester:
<select name="sem" id="sem" label="Semester">
<?php
	if(!empty($_GET['batch']))
	{
		if (isset($_GET['sem']))
		{
			echo "<option value=".$_GET['sem']." selected>".$_GET['sem']."</option> ";
		}
		else
		{
			$res1="SELECT DISTINCT sem FROM studinfo where batch = '".$_GET['batch']."' ";
			$result1=mysqli_query($con,$res1) or die(mysqli_error($con));
			$row1= mysqli_fetch_array($result1);
			echo " <option value=".$row1['sem']." selected>".$row1['sem']."</option>";
		}
		$res2="SELECT DISTINCT semester FROM studinfo ";
		$result2=mysqli_query($con,$res2) or die(mysqli_error($con));
		while($row2= mysqli_fetch_array($result2))
		{
			$rows=unserialize($row2['semester']);
			foreach($rows as $key => $value)
			{
				if($value < $row1['sem'])
				echo "<option value=".$value." >".$value."</option> ";
			}
		}
	}
	?>
</select>
<div align="center">
<br/>
<?php
	date_default_timezone_set('Asia/Kolkata');
	$date = date("d-m");


		if(isset($_GET['date1']) && isset($_GET['date2']))
		{
?>
			<input type='text' value="<?php echo $_GET['date1'] ?>" name='date1' size='5' maxlength='5' /> to <input type='text' name='date2' value="<?php echo $_GET['date2'] ?>" size='5' maxlength='5' />
<?php
		}
		else 
		{
			echo "<input type='text' name='date1' size='5' maxlength='5' /> to <input type='text' name='date2' value='$date' size='5' maxlength='5' />";
		}
	
?>
</div>
</form>
<?php
if(isset($_GET['dept']) && isset($_GET['batch']) && isset($_GET['sem']))
{
?>
<div style="text-align:center">  
    <input type="submit" id="submit" name="submit">  
</div>  
<?php } ?>
<div id='loading' align="center" style='display: none'><img src="ajax-loader.gif" title="Loading" /></div>
<br/>
</div>
<script>
$(document).ready( function()
				  {
				  $('#dept').on( 'change', function() 
								{
								var dept = $("form").serializeArray();
								$.ajax({
									   async:false,
									   type: "GET",
									   url:"period.php",
									   data:dept,
									   success: function(result) 
									   {
									   
									   $("#txtHint").html(result);
									   $("#txtHint").show();
									   
									   }
									   })
								});
				  $('#batch').on( 'change', function() 
								 {         
								 var batch = $("form").serializeArray();
								 $.ajax({
										type: "GET",
										url:"period.php",
										data:batch,
										success: function(result) 
										{
										
										$("#txtHint").html(result);
										$("#txtHint").show();
										
										}
										})
								 });
				  $('#section').on( 'change', function() 
								   {         
								   var section = $("form").serializeArray();
								   $.ajax({
										  type: "GET",
										  url:"period.php",
										  data:section,
										  success: function(result) 
										  {
										  
										  $("#txtHint").html(result);
										  $("#txtHint").show();
										  
										  }
										  })
								   });
				  $('#sem').on( 'change', function() 
							   {       
							   var sem = $("form").serializeArray();
							   $.ajax({									  
									  type: "GET",
									  url:"period.php",
									  data:sem,									  
									  success: function(result) 
									  {
									  
									  $("#txtHint").html(result);
									  $("#divshow").show();
									  
									  }
									  })
							   });


				  $('#submit').click( function()
								   {
									 var submit1 = $("form").serializeArray();
									 var loadingdiv = $('#loading').css('display', 'block');
									 $("#loading").html(loadingdiv);
									 $("#loading").show();
									 $.ajax({
											type: "POST",
											url:"period.php",
											data:submit1,									  
											success: function(rest) 
											{
											$("#txtHint").html(rest);
											$("#loading").hide();
											}
											});
						});
						});
</script>
<?php
if(!empty($_POST['dept']))
	{
	$dti= null;
	$dt1=$_POST['date1'];
	$dt2=$_POST['date2'];
	$dept=$_POST['dept'];
	$type=$_POST['type'];
	$batch=$_POST['batch'];
	$sec=$_POST['section'];
	$sem="sem".$_POST['sem'];
	$datetime1 =$dt1."-".date("Y");
	$datetime2 =$dt2."-".date("Y");
	$date1=date_create($datetime1);
	$date2=date_create($datetime2);
	$interval = date_diff($date1, $date2);
	$diff= $interval->days;
	$j=0;
	
	
	$query1="SELECT * FROM timetable where `department` = '$dept' and batch = '$batch' and `section` = '$sec' and `semester` = ".$_POST['sem']." ";
	$resource = mysqli_query($con,$query1) or die(mysqli_error($con));
	$row= mysqli_fetch_array($resource);
	$periods=unserialize($row['timetable']);
	$day=unserialize($row['days']);
	
	$sql = "SELECT DISTINCT subname FROM subject WHERE `department` = '$dept' and `batch` = '$batch' and semester = ".$_POST['sem']." ";
	$result1 = mysqli_query($con,$sql) or die(mysqli_error($con));
	$rows= mysqli_fetch_array($result1);
	$sub=unserialize($rows['subname']);

	echo "<br>";
	
	$query = "SELECT * FROM attendance WHERE `batch` = '$batch' and `department` = '$dept' and `section` = '$sec' ";
	$result = mysqli_query($con,$query) or die(mysqli_error($con));
	foreach($sub as $key => $value)
	{
		$subj[$periods[$value]]=0;
	}
	while($array= mysqli_fetch_array($result))
	{
	$daykey=null;
	$get1=null;
	$c=0;
	$get1=unserialize($array[$sem]);
	for ($i= 0; $i<$diff; $i++) 
	{
	$daykey=null;
    $dti = strtotime("+$i day", strtotime($datetime1));
    $date = date("d-m", $dti);
	$day = date( "D", $dti);
	
	if(array_search($date,$get1))
	for($z=0;$z<8;$z++)
	{
	++$attendance[$array['rollno']][$periods[$day][$z]];
	if($attendance[$array['rollno']][$periods[$day][$z]] > $subj[$periods[$day][$z]] && $attendance[$array['rollno']][$periods[$day][$z]] != null )
	{
	$subj[$periods[$day][$z]]=$attendance[$array['rollno']][$periods[$day][$z]];
	}
//	echo "<br>";
	}
	}
	}
	echo "<table border='2'>";
	echo "<tr><th>Rollno</th>";
	foreach($sub as $key => $value)
	echo "<th>".$value."(".$subj[$value].")"."</th>";
	echo "</tr>";
	$query2 = "SELECT * FROM attendance WHERE `batch` = '$batch' and `department` = '$dept' and `section` = '$sec' ";
	$result2 = mysqli_query($con,$query2) or die(mysqli_error($con));
	while($result5=mysqli_fetch_assoc($result2))
	{
	echo "<tr><td>".$result5['rollno']."</td>";
	foreach($sub as $key => $value)
	echo "<td>".$attendance[$result5['rollno']][$value]."</td>";
	echo "</tr>";
	}
}
	?>