<html>
<head>
<meta http-equiv="Content-Type"  charset="utf-8"/>
<title>
Edit Subject
</title>
</head>
<body>
<style>
td
{
	text-align:center;
}
</style>
<script>
i=0; startrow=0;prev=0;
</script>
<div id="txtHint">
<form name="form" id="form">
<?php
	error_reporting(E_ALL);
	ini_set('display_errors', true);
	include 'config.php';
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
	$res="SELECT DISTINCT semester FROM studinfo ";
	$result=mysqli_query($con,$res) or die(mysqli_error($con));
	if (isset($_GET['sem']))
	{
		echo "<option value=".$_GET['sem']." selected>".$_GET['sem']."</option> ";
	}
	else
	{
		echo " <option value='' >-</option>";
	}
	while($row= mysqli_fetch_array($result))
	{
		$rows=unserialize($row['semester']);
		foreach($rows as $key => $value)
		{
			echo "<option value=".$value." >".$value."</option> ";
		}
	}
	?>
</select>
Subject:
<select name="sbj" id="sbj" label="Subject">
<?php
	if(isset($_GET['sem']))
	{
		$res="SELECT DISTINCT subname FROM semester".$_GET['sem']." ";
		echo $res;
		$result=mysqli_query($con,$res) or die(mysqli_error($con));
		if (isset($_GET['sbj']))
		{
			echo "<option value=".$_GET['sbj']." selected>".$_GET['sbj']."</option> ";
		}
		else
		{
			echo " <option value='' >-</option>";
		}
	}
	while($row= mysqli_fetch_array($result))
	{
		$rows=unserialize($row['subname']);
		print_r($rows);
		foreach($rows as $key => $value)
		{
			echo "<option value=".$value." >".$value."</option> ";
		}
	}
	?>
</select>
Exam Type:
<select name="test" id="test" label="Test">
<option value="">-</option>
<option value="it1">Internal Test I</option>
<option value="it2">Internal Test II</option>
<option value="model">Model Exam</option>
<option value="cgp">Semester Exam</option>
</select>
<script src=" jquery-2.0.2.min.js"></script>
<?php
	if(!empty($_GET))
	{
		
		if(isset($_GET['dept']) && isset($_GET['batch']) && isset($_GET['sem']))
		{			
			
			@		$department = $_GET['dept'];
			@		$batch = $_GET['batch'];
			@		$semester = $_GET['sem'];
			
			if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) 
			{
				echo "<script> startrow=0;</script>";
				$startrow = 0;
			} 
			else 
			{
				$startrow = (int)$_GET['startrow'];
			}
			$con=mysqli_connect("localhost","root","","Aptitude") or die("Error " . mysqli_error($con));
			$qrycnt = "SELECT COUNT(*) FROM students WHERE batch = '$batch' and department = '$department'";
			$rescnt = mysqli_query($con,$qrycnt) or die(mysqli_error($con));
			$count=mysqli_fetch_array($rescnt);
			$query = "SELECT DISTINCT username,password,rollno,mark FROM students WHERE batch = '$batch' and department = '$department' LIMIT $startrow,10";
			$resource = mysqli_query($con,$query) or die(mysqli_error($con));
			$num=mysqli_num_rows($resource);
			if($num>0)
			{
				echo "<table border ='1' align='center' id='dataTable' >"; 
				echo "<tr><th>Roll No</th><th>Username</th><th>password</th><th>Mark</th><tr>";
				for($i=0;$i<$num;$i++)
				{
					$row=mysqli_fetch_array($resource);  
					echo "<script>i++;document.getElementById('count').value=i;</script>";
	?>
<tr><td><?php echo $row['rollno'] ?></td><td><?php echo $row['username'] ?></td><td><?php echo $row['password'] ?></td><td><input type='text' name='mark' id='mark'></td></tr>
<?php
	}			
	if($startrow<$count[0])
	{
		echo '<tr><td></td><td><a href="#" class="next">Next</a></td>';
	}
	$prev = $startrow - 10;
	echo "<script> prev = $prev; startrow = $startrow;</script>";
	if ($prev >= 0)
    echo '<td><a href="#" class="prev">Previous</a></td><td></td</tr>';
	echo "</table>";
	}
	}
	}
?>
<input name="submit" type="submit" id="submit" style="position:relative;margin-left:48%;"/>
<input type="text" style="display:none;position:absolute;" name="count" id="count"/>
</form>
</div>
</div>
<script>
$(document).ready(function()
				  {
				  $('#dept').on( 'change', function() 
								{         
								var dept = $("form").serializeArray();
								$.ajax({
									   type: "GET",
									   url:"exadd.php",
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
								 var batch = $("form").serializeArray();
								 $.ajax({
										type: "GET",
										url:"exadd.php",
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
  							   var sem = $("form").serializeArray();
							   $.ajax({									  
									  type: "GET",
									  url:"exadd.php",
									  data:"dept="+document.getElementById("dept").value+"&batch="+document.getElementById("batch").value+"&sem="+this.value,									  
									  success: function(result) 
									  {
									  
									  $("#txtHint").html(result);
									  $("#txtHint").show();
									  
									  }
									  })
							   });
				  $('.next').click( function()
								   {
								   startrow=startrow+10;
								   $.ajax({
										  type: "GET",
										  url:"exadd.php",
										  data:"dept="+document.getElementById("dept").value+"&batch="+document.getElementById("batch").value+"&sem="+document.getElementById("sem").value+"&startrow="+startrow,
										  success: function(result) 
										  {
										  
										  $("#txtHint").html(result);
										  $("#txtHint").show();
										  
										  }
										  })
								   });	
				  $('.prev').click( function()
								   {
								   prev=startrow-10;
								   $.ajax({
										  type: "GET",
										  url:"exadd.php",
										  data:"dept="+document.getElementById("dept").value+"&batch="+document.getElementById("batch").value+"&sem="+document.getElementById("sem").value+"&startrow="+prev,
										  success: function(result) 
										  {
										  
										  $("#txtHint").html(result);
										  $("#txtHint").show();
										  
										  }
										  })
								   });
				  $('#submit').on('click', function()
								  {
								  var submit = $("form").serializeArray();
								  $.ajax({
										 async: false,
										 type: "POST",
										 url: "exam.php",
										 data: submit,
										 success: function(msg) 
										 {
										 
										 $('#txtHint').hide();
										 $('#spn').html("Subjects are added successfully");
										 $('#spn').append(msg);
										 
										 }
										 });
								  });
				  
				  });
</script>
</body>
</html>