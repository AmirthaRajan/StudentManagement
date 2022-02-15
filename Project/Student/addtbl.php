<html>
<head>
<meta http-equiv="Content-Type" charset="utf-8"/>
<title>Add TimeTable</title>
<style>
input[type='text']
{
text-align:center;
}
</style>	
</head>
<?php
	error_reporting(E_ALL);
	ini_set('display_errors', true);
	include 'config.php';
?>
<body>
<span id="spn" align="center"></span>
<div id="txtHint">
<form>
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
			echo " <option value='' >-</option>";
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
<table border="1" align="center" id="dataTable">
<tr><th>Day &#92; Periods</th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th></tr>
<tr><th>Monday 		</th><td><input type="text" name="sbj[Mon][]" id="sbj[Mon][]"></td><td><input type="text" name="sbj[Mon][]" id="sbj[Mon][]"></td><td><input type="text" name="sbj[Mon][]" id="sbj[Mon][]"></td><td><input type="text" name="sbj[Mon][]" id="sbj[Mon][]"></td><td><input type="text" name="sbj[Mon][]" id="sbj[Mon][]"></td><td><input type="text" name="sbj[Mon][]" id="sbj[Mon][]"></td><td><input type="text" name="sbj[Mon][]" id="sbj[Mon][]"></td><td><input type="text" name="sbj[Mon][]" id="sbj[Mon][]"></td></tr>
<tr><th>Tuesday 	</th><td><input type="text" name="sbj[Tue][]" id="sbj[Tue][]"></td><td><input type="text" name="sbj[Tue][]" id="sbj[Tue][]"></td><td><input type="text" name="sbj[Tue][]" id="sbj[Tue][]"></td><td><input type="text" name="sbj[Tue][]" id="sbj[Tue][]"></td><td><input type="text" name="sbj[Tue][]" id="sbj[Tue][]"></td><td><input type="text" name="sbj[Tue][]" id="sbj[Tue][]"></td><td><input type="text" name="sbj[Tue][]" id="sbj[Tue][]"></td><td><input type="text" name="sbj[Tue][]" id="sbj[Tue][]"></td></tr>
<tr><th>Wednesday 	</th><td><input type="text" name="sbj[Wed][]" id="sbj[Wed][]"></td><td><input type="text" name="sbj[Wed][]" id="sbj[Wed][]"></td><td><input type="text" name="sbj[Wed][]" id="sbj[Wed][]"></td><td><input type="text" name="sbj[Wed][]" id="sbj[Wed][]"></td><td><input type="text" name="sbj[Wed][]" id="sbj[Wed][]"></td><td><input type="text" name="sbj[Wed][]" id="sbj[Wed][]"></td><td><input type="text" name="sbj[Wed][]" id="sbj[Wed][]"></td><td><input type="text" name="sbj[Wed][]" id="sbj[Wed][]"></td></tr>
<tr><th>Thursday 	</th><td><input type="text" name="sbj[Thu][]" id="sbj[Thu][]"></td><td><input type="text" name="sbj[Thu][]" id="sbj[Thu][]"></td><td><input type="text" name="sbj[Thu][]" id="sbj[Thu][]"></td><td><input type="text" name="sbj[Thu][]" id="sbj[Thu][]"></td><td><input type="text" name="sbj[Thu][]" id="sbj[Thu][]"></td><td><input type="text" name="sbj[Thu][]" id="sbj[Thu][]"></td><td><input type="text" name="sbj[Thu][]" id="sbj[Thu][]"></td><td><input type="text" name="sbj[Thu][]" id="sbj[Thu][]"></td></tr>
<tr><th>Friday 		</th><td><input type="text" name="sbj[Fri][]" id="sbj[Fri][]"></td><td><input type="text" name="sbj[Fri][]" id="sbj[Fri][]"></td><td><input type="text" name="sbj[Fri][]" id="sbj[Fri][]"></td><td><input type="text" name="sbj[Fri][]" id="sbj[Fri][]"></td><td><input type="text" name="sbj[Fri][]" id="sbj[Fri][]"></td><td><input type="text" name="sbj[Fri][]" id="sbj[Fri][]"></td><td><input type="text" name="sbj[Fri][]" id="sbj[Fri][]"></td><td><input type="text" name="sbj[Fri][]" id="sbj[Fri][]"></td></tr>
</table>
<br/>
<input name="submit" type="submit" id="submit" />
</div>
</form>
</div>
<script src="jquery-2.0.2.min.js"></script>
<script>
$(document).ready( function()
				  {
				  $('#dept').change(function() 
								{         
								$.ajax({
									   
									   type: "GET",
									   url:"addtbl.php",
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
								 $.ajax({
										type: "GET",
										url:"addtbl.php",
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
								   $.ajax({
										  type: "GET",
										  url:"addtbl.php",
										  data:"dept="+document.getElementById("dept").value+"&batch="+document.getElementById("batch").value+"&section="+this.value,
										  success: function(result) 
										  {
										  
										  $("#txtHint").html(result);
										  $("#txtHint").show();
										  
										  }
										  })
								   });
				  $('#sem').on( 'change', function() 
							   {
							   $.ajax({									  
									  type: "GET",
									  url:"addtbl.php",
									  data:"dept="+document.getElementById("dept").value+"&batch="+document.getElementById("batch").value+"&section="+document.getElementById("section").value+"&sem="+this.value,									  
									  success: function(result) 
									  {
									  
									  $("#txtHint").html(result);
									  $("#txtHint").show();
									  
									  }
									  })
							   });
				  $('#submit').click( function() 
								  {       
								  var submit = $("form").serializeArray();
								  $.ajax({
									  	 async:false,
										 type: "POST",
										 url:"timetable.php",
										 data:submit,									  
										 success: function(result) 
										 {
										 $("#txtHint").hide();
										 $('#spn').html(result);
										 
										 }
										 })
								  });
				  });
</script>
</body>
</html>