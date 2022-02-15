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
	
	if(isset($_GET['regno']))
	{
		$regno = $_GET['regno'];
		$query = "SELECT * FROM semester".$i." WHERE rollno = '".$regno."'"; 
		$resource = mysqli_query($con,$query) or die(mysqli_error($con));
		$result = mysqli_fetch_assoc($resource);		
		echo "<p id='check' style='font-size:26px;'>".$result['name']." has successfully been removed</p>";
		$query1 = "DELETE FROM semester".$i." subject IN (1) WHERE rollno = '".$rollno."' "; 
		mysqli_query($con,$query1) or die(mysqli_error($con));
		$qry="ALTER TABLE semester".$i." DROP id ";
		if (!mysqli_query($con,$qry))
		{
			die('Error: ' . mysqli_error($con));
		}
		$stu="ALTER TABLE semester".$i." ADD id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";
		if (!mysqli_query($con,$stu))
		{
			die('Error: ' . mysqli_error($con));
		}
		mysqli_close($con); 
	}
	?>
<script>
function show(rollno)
{
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","rmvstu.php?rollno="+rollno,true);
	xmlhttp.send();
}
</script>
<table id="roll" align="center">
<form >
<tr><td>Enter the Rollno</td><td>:</td><td><input type="text" name"rollno" id="no"></td><td><input type="button" id="btn" value="Delete" onclick="show(no.value)"></td></tr>
</form>
</table>
<script src=" jquery-2.0.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
				  {
				  var that = $(this),val = that.val();
				  $('#btn').click(function()
								  {
								  $('#roll').hide();
								  });
				  
				  $('#check').change(function()
									 {
									 $('#roll').hide();
									 });
				  });
</script>
<div id="txtHint" style="text-align:center;"></div>
</body>
</html>