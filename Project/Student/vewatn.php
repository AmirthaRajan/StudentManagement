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
	ini_set('max_execution_time', 300);
	error_reporting(E_ALL ^ E_NOTICE);
	ini_set('display_errors', true);
	include 'config.php';
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
Date:
<select name="type" id="type" label="Date">
<?php
	if (isset($_GET['type']))
	{
		echo "<option value=".$_GET['type']." selected>".$_GET['type']."</option> ";
	}
	else
	{
		echo " <option value='OneDay' >OneDay</option>";
	}
	echo " <option value='OneDay' >OneDay</option>";
	echo "<option value='MultipleDays'>MultipleDays</option>";
?>
</select>
<br/>
<div align="center">
<br/>
<?php
	date_default_timezone_set('Asia/Kolkata');
	$date = date("d-m");
	if (isset($_GET['type']))
	{
	if($_GET['type'] == 'MultipleDays')
	{
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
	}
	else
	{
	//	echo "<select name='date' label='Date'>";
		if(isset($_GET['date']))
		{
			echo "<input type='text' name='date' value='".$_GET['date']."' size='5' maxlength='5' />";
			//echo "<option value=".$value." >".$value."</option> ";
		}
		else
		{
			echo "<input type='text' name='date' value='$date' size='5' maxlength='5' />";
	/*		$res0="SELECT * FROM attendance where rollno= 'admin' ";
			$result0=mysqli_query($con,$res0) or die(mysqli_error($con));
			$row0= mysqli_fetch_array($result0);
			if(isset($_GET['sem']))
			{
			$seme="sem".$_GET['sem'];
			$rows=unserialize($row0[$seme]); 
			$i=5;
			$j=0;
			foreach($rows as $key => $value)
			{
				if($j++ < $i)
				echo "<option value=".$value." >".$value."</option> ";
			}
			}
			*/
		}
	//	echo "</select>";
		
	}
	}
	
?>
</div>
</form>
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
									   url:"vewatn.php",
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
										url:"vewatn.php",
										data:"dept="+document.getElementById("dept").value+"&batch="+this.value,
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
										  url:"vewatn.php",
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
									  url:"vewatn.php",
									  data:sem,									  
									  success: function(result) 
									  {
									  
									  $("#txtHint").html(result);
									  $("#divshow").show();
									  
									  }
									  })
							   });
				  $('#type').on( 'change', function() 
							   {       
							   var sem = $("form").serializeArray();
							   $.ajax({									  
									  type: "GET",
									  url:"vewatn.php",
									  data:sem,									  
									  success: function(result) 
									  {
									  
									  $("#txtHint").html(result);
									  $("#divshow").show();
									  
									  }
									  })
							   });
				  <?php
				  if(!empty($_GET['dept']) && !empty($_GET['batch']) && !empty($_GET['sem']) && !empty($_GET['section']) && $_GET['batch'] != 'selected' && $_GET['sem'] != 'selected' && $_GET['section'] !== 'selected')
				  {
				   ?>
				   $('#section').on( 'change', function() 
								   {  
									 var submit1 = $("form").serializeArray();
									 var loadingdiv = $('#loading').css('display', 'block');
									 $("#loading").html(loadingdiv);
									 $("#loading").show();
									 $.ajax({
											type: "GET",
											url:"vewatn.php?view="+1,
											data:submit1,									  
											success: function(rest) 
											{
											$("#txtHint").html(rest);
											$("#loading").hide();
											}
											})
								   });
				<?php				
				  }
				 ?>
				  });
</script>

<div id="data" align="center">
<?php
if(isset($_GET['view']))
{
	$dt=$_GET['date'];
	$dt1=$_GET['date1'];
	$dt2=$_GET['date2'];
	$dept=$_GET['dept'];
	$type=$_GET['type'];
	$batch=$_GET['batch'];
	$sec=$_GET['section'];
	$sem="sem".$_GET['sem'];
	$query = "SELECT * FROM attendance WHERE batch = $batch and department = '$dept' and section = '$sec' ";
	$result = mysqli_query($con,$query) or die(mysqli_error($con));
	if($type == 'OneDay')
	{
	echo "<div align='center'>";
	echo "<table border='2'>";
	echo "<tr><th>Name</th><th>Rollno</th><th>Attendance</th></tr>";
	while($array= mysqli_fetch_array($result))
	{
	$get1=unserialize($array[$sem]);

		$key = array_search($dt,$get1);
		if($key == null)
		$key = '0';
		else
		$key = '1';
		echo "<tr><td>".$array['name']."</td><td>".$array['rollno']."</td><td>".$key."</td></tr>";

	}
	echo "</table></div>";
	}
	else
	{
	$dti= null;
	$datetime1 =$dt1."-".date("Y");
	$datetime2 =$dt2."-".date("Y");
	$date1=date_create($datetime1);
	$date2=date_create($datetime2);
	$interval = date_diff($date1, $date2);
//	print_r($inetrval);
	$diff= $interval->days;
	$j=0;
	
	while($array= mysqli_fetch_array($result))
	{
		$c=0;
	$get1=unserialize($array[$sem]);
	for ($i= 0; $i<$diff; $i++) 
	{
	$found = 0;
    $dti = strtotime("+$i day", strtotime($datetime1));
    $date = date("d-m", $dti);
	$found = array_search($date,$get1);
	if($found != null)
	{
	$keyfound[$c]=$found;
	$c++;
	}
	}
//	print_r($keyfound);
	}
	$query3 = "SELECT * FROM attendance WHERE batch = $batch and department = '$dept' and section = '$sec' ";
	$resource3=mysqli_query($con,$query3) or die(mysqli_error($con));
	$num=mysqli_num_rows($resource3);
	for($no=0;$no<$num;$no++)
	{
	$result3= mysqli_fetch_assoc($resource3);
	$key=0;
	$abs=0;
	$get1=unserialize($result3[$sem]);
	for($i=0;$i<$c;$i++)
	{
	if($get1[$keyfound[$i]]!='a')
	{
	$key++;
	}
	else
	{
	$abs++;
	}
	}
//	$abs=array_count_values($get1);
//	if($abs['a']==null)
//	$abs['a']=0;
$rowno[$j]=$result3['rollno'];
$rowna[$j]=$result3['name'];
$pres[$j]=$key;
$absc[$j]=$abs;
$j++;
	}
/*	$query1 = "SELECT $sem FROM period WHERE `department`= '$dept' and  `batch` = ".$batch."";
	$resource1 = mysqli_query($con,$query1) or die(mysqli_error($con));
	$result1 = mysqli_fetch_assoc($resource1);
	$sub1=unserialize($result1[$sem]);
*/
	echo "<table border='2'>";
	echo "<tr><th>Name</th><th>Rollno</th><th>Days Present</th><th>Days Absent</th>";
/*	for($i=0;$i<sizeof($sub1);$i++)
	foreach($sub1 as $k => $value)
	echo "<th>".$k."</th>";
	echo "</tr>";
*/
	echo "<div align='center'>";
	for($m=0;$m<=$j;$m++)
	{
/*	$query2="SELECT $sem FROM period WHERE rollno ='".$rowno[$m]."'";
	$resource2=mysqli_query($con,$query2) or die(mysqli_error($con));
	$result2=mysqli_fetch_assoc($resource2);
	$sub=unserialize($result2[$sem]);
*/
	echo "<tr><td>".$rowna[$m]."</td><td>".$rowno[$m]."</td><td>".$pres[$m]."</td><td>".$absc[$m]."</td>";
/*	foreach($sub1 as $k => $value)
	echo "<td>".$value."</td>";
	echo "</td>";
*/
	}
	echo "</table></div>";
	}
}

?>

</div>
<div id='loading' align="center" style="display:none;" ><img src="ajax-loader.gif" title="Loading" ></div>
</body>
</html>
