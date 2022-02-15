<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>
Add Attendance
</title>
</head>
<?php
		header("Access-Control-Allow-Origin : *");
		error_reporting(E_ALL);
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
		echo "<option value='' >-</option>";
	}
	while($row = mysqli_fetch_assoc($result))
	{
		echo "<option value=".$row['department']." >".$row['department']."</option> ";
	}
	?>
</select>
Batch:
<select name="batch" id="batch" label="Batch" onchange="batch(dept.value,this.value)">
<?php
	
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
				if($value <= $row1['sem'] )
				echo "<option value=".$value." >".$value."</option> ";
			}
		}
	}
	?>
</select>
Section:
<select name="section" id="section" label="section">
<?php
	
	if(isset($_GET['batch']))
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
</br>
<div align="center">
<input type="button" value="Add Student" name="add" id="add" onClick="addRow('dataTable')">
<input type="button" value="Remove Student" name="delete" id="delete" onClick="deleteRow('dataTable')">
<input type="text" style="display:none" name="count" id="count" />
<br/>
<?php
date_default_timezone_set('Asia/Calcutta');
$datetime = new DateTime('now');
	if(isset($_GET['date']))
	{
	echo "<input type='text' name='date' value='".$_GET['date']."' size='5' maxlength='5' />";
	$date = $_GET['date']."-".date("Y");
	$timestamp = strtotime($date);
	$day = date( "D", $timestamp);
	echo "<input type='text' name='day' value='$day' size='5' maxlength='5' />";
	}
	else
	{
	$date1 = date("d-m-Y");
	$date = date("d-m");
	echo "<input type='text' name='date' value='$date' size='5' maxlength='5' />";
	$timestamp = strtotime($date1);
	$day = date('D', $timestamp);
	echo "<input type='text' name='day' value='$day' size='5' maxlength='5' />";
	}
	

?>
</div>
<table border="1" align="center" id="dataTable">
<tr><th></th><th>Student Rollno</th></tr>
<tr><td><input type="checkbox" name="chkbox[]" id="chkbox[]" > </td><td><input type="text" name="rollno[]" id="rollno[]" value="<?php echo @$_GET['batch'].'PIT'.@$_GET['dept'] ?>"></td></tr>
</table>
<div style="position:relative;" align="center">
<?php
	if(isset($_GET['dept']) && isset($_GET['batch']) && isset($_GET['sem']) && isset($_GET['section']))
	{
		echo "<input name='submit' type='submit' id='submit' />";
	} 
?>
</div>
</form>
<script src="jquery-2.0.2.min.js"></script>
<script language="javascript">
i=1;
document.getElementById("count").value=i;
function addRow(tableID) 
{
	
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
	element2.name = "rollno[]";
	element2.value = "<?php echo @$_GET['batch'].'PIT'.@$_GET['dept'] ?>";
	cell2.appendChild(element2);
	
	++i;
	document.getElementById("count").value=i;
}
function deleteRow(tableID) {
	try {
		var table = document.getElementById(tableID);
		var rowCount = table.rows.length;
		
		i--;	
		document.getElementById("count").value=i;
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
</div>
<div id='loading' align="center" ></div>
<script>
$(document).ready( function()
					  {

				
$('#dept').on( 'change', function() 
								{         
								$.ajax({
									   async: false,
									   type: "GET",
									   url:"addatn.php",
									   data:"dept="+this.value,
									   success: function(result) 
									   {
									   
									   $("#txtHint").html(result);
									   }
									   })
								});
$('#batch').on( 'change', function() 
								 {         
								 $("#txtHint").hide();
								 $.ajax({
										async: false,
										type: "GET",
										url:"addatn.php",
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
					url:"addatn.php",
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
					url:"addatn.php",
					data:sem,									  
					success: function(result) 
					{
					
					$("#txtHint").html(result);
					$("#txtHint").show();
					
					}
					})
			 });
$('#submit').on('click', function(event)
{
			event.preventDefault();
			document.getElementById('loading').innerHTML='<img src="ajax-loader.gif" />';
		    var submit1 = $("form").serializeArray();
			$("#txtHint").hide();
			event.preventDefault();
			   $.ajax({
					  
					  type: "POST",
					  url:"attendance.php",
					  data:submit1,			  
					  success: function(result) 
					  {
						//$("#txtHint").show(result);
						$("#txtHint").show("<center>Attendance is Successfully Entered</center>");
						//$("#txtHint").append("<center>Attendance is Successfully Entered</center>");
						$('#loading').hide();
						
					  }
					  })
				   	});
				});
</script>
</body>
</html>
