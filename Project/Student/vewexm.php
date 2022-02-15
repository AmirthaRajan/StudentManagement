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
Subject:
<select name="sbj" id="subj" label="Subject">
<?php		
	if(!empty($_GET['sem']))
	{
		$res="SELECT DISTINCT subname FROM subject WHERE department = '".$_GET['dept']."' and batch = ".$_GET['batch']." and semester = ".$_GET['sem']." ";
		$result=mysqli_query($con,$res) or die(mysqli_error($con));
		
		if (isset($_GET['sbj']))
		{
			echo "<option value=".$_GET['sbj']." selected>".$_GET['sbj']."</option> ";
		}
		else
		{
			echo " <option value='' >-</option>";
		}
		while($row = mysqli_fetch_assoc($result))
		{
			$rows=unserialize($row['subname']);
			foreach($rows as $keys => $value)
			{
				echo "<option value=".$value." >".$value."</option> ";
			}
		}
		echo " <option value='All' >All</option>";
	}
	?>
</select>	
Exam Type:
<select name="test" id="test" label="Test">
<?php
	if(isset($_GET['sbj']))
	{
		if (isset($_GET['test']))
		{
			echo "<option value=".$_GET['test']." selected>".$_GET['test']."</option> ";
		}
		else
		{
			echo " <option value='' >-</option>";
		}
		?>
<option value="InternalTest1">Internal Test I</option>
<option value="InternalTest2">Internal Test II</option>
<option value="ModelExam">Model Exam</option>
<option value="gpa">Semester Exam</option>
<?php } ?>
</select>
<script src=" jquery-2.0.2.min.js"></script>
<?php
	echo "</br>";
	if(!empty($_GET))
	{
		
		if(isset($_GET['dept']) && isset($_GET['batch']) && isset($_GET['sem']) && isset($_GET['test']) && isset($_GET['sbj']))
		{			
			
			@		$department = $_GET['dept'];
			@		$batch = $_GET['batch'];
			@		$semester = $_GET['sem'];
			
		
/*			$qrycnt = "SELECT COUNT(*) FROM semester".$semester." WHERE batch = '$batch' and department = '$department'";
			$rescnt = mysqli_query($con,$qrycnt) or die(mysqli_error($con));
			$count=mysqli_fetch_array($rescnt);	
*/
			$query = "SELECT regno,rollno,name,".$_GET['test']." FROM semester".$semester." WHERE batch = '$batch' and department = '$department' ";
			$resource = mysqli_query($con,$query) or die(mysqli_error($con));
			$num=mysqli_num_rows($resource);
			$subqry = "SELECT subname FROM subject WHERE batch = '$batch' and department = '$department' and semester = '$semester' ";
			$subres = mysqli_query($con,$subqry) or die(mysqli_error($con));
			$sub=mysqli_fetch_assoc($subres);
			if($_GET['sbj']!="All")
			{
			if($num>0)
			{
				echo "<table border ='1' align='center' id='dataTable' >"; 
				echo "<tr><th>Reg No</th><th>Roll No</th><th>Name</th><th>Mark</th><tr>";
				for($i=0;$i<$num;$i++)
				{	$j=0;
					$row=mysqli_fetch_array($resource);
					$subrows=unserialize($sub['subname']);
					foreach($subrows as $keys => $value)
					{	
						if($value == $_GET['sbj'])
						{
							$rowt=$row[$_GET['test']];
							$val[]=unserialize($rowt);
							
							?>
<tr><td><?php echo $row['regno'] ?></td><td><?php echo $row['rollno'] ?></td><td><?php echo $row['name'] ?></td><td><?php @ print_r($val[$i][$j]) ?></td></tr>
<?php
	echo "<script>i++;document.getElementById('count').value=i;</script>";	
	}
	$j++;
	}
	}		
	echo "</table>";
	}
	}
	else
	{
	if($num>0)
			{
				echo "<table border ='1' align='center' id='dataTable' >"; 
				echo "<tr><th>Reg No</th><th>Roll No</th><th>Name</th>";
				$subrows=unserialize($sub['subname']);
				
				foreach($subrows as $keys => $value)
					{	
					echo "<th>".$value."</th>";
					$subjectname[$keys]=$value;
					}
					echo "</tr>";
				$query = "SELECT regno,rollno,name,".$_GET['test']." FROM semester".$semester." WHERE batch = '$batch' and department = '$department' ";
				$resource = mysqli_query($con,$query) or die(mysqli_error($con));
				
				for($i=0;$i<$num;$i++)
				{	
					$j=0;
					$row2=mysqli_fetch_array($resource);
					echo "<tr><td>".$row2['regno']."</td><td>".$row2['rollno']."</td><td>".$row2['name']."</td>";
					$rows2=unserialize($row2[$_GET['test']]);
					for($k=0;$k<count($subrows);$k++)
					{
							
?>
<td><?php @ print_r($rows2[$k]); ?></td>
<?php
					}
	echo "<script>i++;document.getElementById('count').value=i;</script>";	
	$j++;
	}
	echo "</tr>";
	}		
	echo "</table>";
	}
	}
	} 
	?>
<input type="text" style="display:none;position:absolute;" name="count" id="count"/>
</form>
</div>
<span id="spn"></span>
<script>
$(document).ready(function()
				  {
				  $('#dept').on( 'change', function() 
								{         
								var dept = $("form").serializeArray();
								$.ajax({
									   type: "GET",
									   url:"vewexm.php",
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
										url:"vewexm.php",
										data:batch,
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
									  url:"vewexm.php",
									  data:sem,									  
									  success: function(result) 
									  {
									  
									  $("#txtHint").html(result);
									  $("#txtHint").show();
									  
									  }
									  })
							   });
				  $('#subj').on( 'change', function() 
								{       
								var sbj = $("form").serializeArray();
								$.ajax({									  
									   type: "GET",
									   url:"vewexm.php",
									   data:sbj,									  
									   success: function(result) 
									   {
									   
									   $("#txtHint").html(result);
									   $("#txtHint").show();
									   
									   }
									   })
								});				  
				  $('#test').on( 'change', function() 
								{       
								var test = $("form").serializeArray();
								$.ajax({									  
									   type: "GET",
									   url:"vewexm.php",
									   data:test,									  
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