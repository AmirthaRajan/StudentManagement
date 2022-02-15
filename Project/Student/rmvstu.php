<html>
<head>
<meta http-equiv="Content-Type"  charset="utf-8"/>
<title>
View Student
</title>
<style>
input[type=button]:hover 
{ 
transition: .65s ease-in-out;
	-moz-transition: .65s ease-in-out;
color:#FF0000;
}

input[type=button] 
{	
transition: .65s ease-in-out;
	-moz-transition: .65s ease-in-out;
color:#000000;
	font-size: 26px;
}
</style>
</head>
<body>
<?php
include 'config.php';

	if(isset($_GET['rollno']))
	{
		$rollno = $_GET['rollno'];
		$query = "SELECT * FROM studinfo WHERE rollno = '".$rollno."'"; 
		$resource = mysqli_query($con,$query) or die(mysqli_error($con));
		$result = mysqli_fetch_assoc($resource);		
		echo "<p id='check' style='font-size:26px;'>".$result['name']." has successfully been removed</p>";
		$query1 = "DELETE FROM studinfo WHERE rollno = '".$rollno."'"; 
		mysqli_query($con,$query1) or die(mysqli_error($con));
		$qry="ALTER TABLE studinfo DROP id ";
		if (!mysqli_query($con,$qry))
		{
			die('Error: ' . mysqli_error($con));
		}
		for($i=1;$i<9;$i++)
		{
			$sql1="DELETE FROM semester".$i." WHERE rollno = '".$rollno."'";
			mysqli_query($con,$sql1);
		}
		$sql2="DELETE FROM attendance WHERE rollno = '".$rollno."'";
		mysqli_query($con,$sql2);
		$sql3="DELETE FROM period WHERE rollno = '".$rollno."'";
		mysqli_query($con,$sql3);
		$stu="ALTER TABLE studinfo ADD id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";
		if (!mysqli_query($con,$stu))
		{
			die('Error: ' . mysqli_error($con));
		}
		mysqli_close($con); 
	}
	?>
<table id="roll" align="center">
<form >
<tr><td>Enter the Rollno</td><td>:</td><td><input type="text" name"rollno" id="no"></td><td><input type="button" id="btn" value="Delete" ></td></tr>
</form>
</table>
<div id='loading' align="center" style='display: none'><img src="ajax-loader.gif" title="Loading" /></div>
<script src=" jquery-2.0.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
				  {
				   var that = $(this),val = that.val();
				  $('#btn').click(function()
								  {
								  $('#roll').hide();
								  $('#check').show();
								  });
				  
				  $("#btn").click( function()
								  {
								  var loadingdiv = document.getElementById('loading');
								  loadingdiv.style.display = "block";
								  $.ajax({
										 type:"GET",
										 url:"rmvstu.php",
										 data:"rollno="+document.getElementById("no").value,
										 success: function(data)
										 {
										 var loadingdiv = document.getElementById('loading');
										 loadingdiv.style.display = "none";
										 var chang  = document.getElementById('check');
										 $("#txtHint").html(data);
										 }
										 });
								  });
										 
				});
</script>
<div id="txtHint" style="text-align:center;"></div>
</body>
</html>