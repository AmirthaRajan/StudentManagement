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
i=0;
</script>
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
				if($value <= $row1['sem'])
				echo "<option value=".$value." >".$value."</option> ";
			}
		}
	}
	?>
</select>
<script src=" jquery-2.0.2.min.js"></script>
<div align="center">
<input type="button" value="Add Subject" name="add" id="add" onClick="addRow('dataTable')">
<input type="button" value="Delete Subject" name="delete" id="delete" onClick="deleteRow('dataTable')">
<br/>
<?php
	if(!empty($_GET))
	{
		echo "<table border ='1' align='center' id='dataTable' >"; 
		echo "<tr><th></th><th>Subject Code</th><th>Subject Name</th><th>Subject Credits</th><tr>";
		
		if(isset($_GET['dept']) && isset($_GET['batch']) && isset($_GET['sem']))
		{
			@		$department = $_GET['dept'];
			@		$batch = $_GET['batch'];
			@		$semester = $_GET['sem'];
			$query = "SELECT DISTINCT subcdt,subcode,subname FROM subject WHERE department = '".$department."' and batch = '".$batch."' and semester = ".$semester." "; 
			$resource = mysqli_query($con,$query) or die(mysqli_error($con));
			while($result = mysqli_fetch_array($resource))
			{
				
				$row1=unserialize($result['subcode']);
				if($i == 0)
				{
					$count = sizeof($row1);
				}
				$row2=unserialize($result['subname']);
				$row3=unserialize($result['subcdt']);
				for($j=0;$j<$count;$j++)
				{
					if($row2[$j] != null)
					{
					echo "<script>i++;document.getElementById('count').value=i;</script>";
					echo "<tr><td><input type='checkbox' name='chkbox[]' id='chkbox[]'></td><td><input type='text' name='code[]' id='code[]' value=".$row1[$j]." ></td><td><input type='text' name='name[]' id='name[]' value='".$row2[$j]."' ></td><td><input type='text' name='credit[]' id='credit[]' value=".$row3[$j]." ></td></tr>";
					}
					else
					{
						--$count;
					}
				}
			}
			
			
		}
		echo "</table>";
	}	
?>
<br/>
<input name="submit" type="submit" id="submit" />
</div>
</form>
<input type="text" style="display:none;position:absolute;" name="count" id="count"/>
</div>
</div>
<script language="javascript">
function addRow(tableID) 
{
	document.getElementById("count").value=i;
	var table = document.getElementById(tableID);
	
	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);
	
	var cell1 = row.insertCell(0);
	var element1 = document.createElement("input");
	element1.type = "checkbox";
	element1.name="chkbox[]";
	cell1.appendChild(element1);
	
	var cell2 = row.insertCell(1);
	var element2 = document.createElement("input");
	element2.type = "text";
	element2.name = "code[]";
	cell2.appendChild(element2);
	
	var cell3 = row.insertCell(2);
	var element3 = document.createElement("input");
	element3.type = "text";
	element3.name = "name[]";
	cell3.appendChild(element3);
	
	var cell4 = row.insertCell(3);
	var element4 = document.createElement("input");
	element4.type = "text";
	element4.name = "credit[]";
	cell4.appendChild(element4);
	i++;
	
}
function deleteRow(tableID) {
	try {
		var table = document.getElementById(tableID);
		var rowCount = table.rows.length;
		
		i--;	
		
		for(var j=0; j<rowCount; j++) {
			var row = table.rows[j];
			var chkbox = row.cells[0].childNodes[0];
			if(null != chkbox && true == chkbox.checked) 
			{
				table.deleteRow(j);
				rowCount--;
				j--;
			}						
		}
	}
	catch(e) 
	{
		alert(e);
	}
}
</script>
<script>
$(document).ready(function()
				  {
				  
				  $('#dept').on( 'change', function() 
								{         
								$("#txtHint").hide();
								$.ajax({
									   type: "GET",
									   url:"edtsbj.php",
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
										url:"edtsbj.php",
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
									  url:"edtsbj.php",
									  data:"dept="+document.getElementById("dept").value+"&batch="+document.getElementById("batch").value+"&sem="+this.value,
									  success: function(result) 
									  {
									  
									  $("#txtHint").html(result);
									  $("#txtHint").show();
									  
									  }
									  })
							   });
				  $('#submit').on('click', function()
								  {
								  event.preventDefault();
								  var str = $("form").serializeArray();
								  // event.preventDefault();
								  $.ajax({
										 type: "POST",
										 url: "subject.php",
										 data: str,
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