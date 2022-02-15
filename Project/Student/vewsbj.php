<html>
<head>
<meta http-equiv="Content-Type"  charset="utf-8"/>
<title>
View Subject
</title>
</head>
<body>
<style>
td
{
	text-align:center;
}
</style>
<div id="txtHint">
<form>
<?php
	error_reporting(E_ALL);
	ini_set('display_errors', true);
	include 'config.php';
	$i=0;
?>
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
		echo "<option value='' >-</option>";
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
			echo " <option value='' >-</option>";
		}
		while($row = mysqli_fetch_assoc($result))
		{
			echo "<option value=".$row['batch']." >".$row['batch']."</option> ";
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
				echo "<option value=".$value." >".$value."</option> ";
			}
		}
	}
	?>
</select>
</form>
</div>
<script src=" jquery-2.0.2.min.js"></script>
<?php
	if(!empty($_GET))
	{
		echo "<br/>";
		echo "<table border ='1' align='center'>"; 
		echo "<tr><th>Subject Code</th><th>Subject Name</th><th>Subject Credits</th><tr>";
		
		if(isset($_GET['dept']) && isset($_GET['batch']) && isset($_GET['sem']))
		{
			@		$department = $_GET['dept'];
			@		$batch = $_GET['batch'];
			@		$semester = $_GET['sem'];
			$query = "SELECT DISTINCT subcdt,subcode,subname FROM subject WHERE department = '".$department."' and batch = '".$batch."' and semester = '".$semester."' "; 
			$resource = mysqli_query($con,$query) or die(mysqli_error($con));
			while($result = mysqli_fetch_array($resource))
			{
				

				$row1=unserialize($result['subcode']);
			if($i == 0)
			{
				$count=sizeof($row1);
			}			
				$row2=unserialize($result['subname']);
				$row3=unserialize($result['subcdt']);
				for($j=0;$j<$count;$j++)
				{
				echo "<tr><td>".$row1[$j]."</td><td>".$row2[$j]."</td><td>".$row3[$j]."</td></tr>";
					$i++;
				}
			}

				
		}
		echo "</table>";
	}	
?>
<script>
$(document).ready(function()
				  {
				  
				  $('#dept').on( 'change', function() 
								{         
								$("#txtHint").hide();
								$.ajax({
									   type: "GET",
									   url:"vewsbj.php",
									   data:"dept="+this.value,
									   success: function(result) 
									   {
									   
									   $("#txtHint").html(result);
									   $("#txtHint").show();
									   
									   }
									   })
								});
				  $('#batch').on( 'change', function() 
								 {         
								 $("#txtHint").hide();
								 $.ajax({
										type: "GET",
										url:"vewsbj.php",
										data:"dept="+document.getElementById("dept").value+"&batch="+this.value,
										success: function(result) 
										{
										
										$("#txtHint").html(result);
										$("#txtHint").show();
										
										}
										})
								 });
				  $('#sem').on( 'change', function() 
								{         
								$("#txtHint").hide();
								$.ajax({
									   type: "GET",
									   url:"vewsbj.php",
									   data:"dept="+document.getElementById("dept").value+"&batch="+document.getElementById("batch").value+"&sem="+this.value,
									   success: function(result) 
									   {
									   
									   $("#txtHint").html(result);
									   $("#txtHint").show();
									   
									   }
									   })
								});
				  });
</script>
</body>
</html>