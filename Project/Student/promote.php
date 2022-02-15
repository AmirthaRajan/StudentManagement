<html>
<head>
<meta http-equiv="Content-Type"  charset="utf-8"/>
<title>
Promote Batch
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
	font-size: 24px;
}
td
{
    font-size: 26px;
}
</style>
</head>
<body>
<?php
include 'config.php';
	if (!$con)
	{
		die('Could not connect: ' . mysqli_error($con));
	}	
	if(isset($_GET['batch']))
	{
		$batch = $_GET['batch'];
		$query = "SELECT * FROM studinfo WHERE batch = '".$batch."'"; 
		$resource = mysqli_query($con,$query) or die(mysqli_error($con));
		$result = mysqli_fetch_assoc($resource);
        $sem = $result['sem'];
        if($_GET['id']==1)
        {
        if($sem < 8 && $sem != 'Alumni')
        {
        $sem = $result['sem']+1;
        echo $sem;
        echo "<p id='check' align='center' style='font-size:26px;'>".$result['batch']." has successfully been promoted!!</p>";
        }
        else if($sem == 8)
        $sem = 'Alumni';
		else
		echo "<script>document.getElementById('error').innerHTML = 'Alumni Cannot be promoted!!' </script>";
        }
        if($_GET['id']==2)
        {
        if($sem > 1 && $sem != 'Alumni')
        {
        $sem = $result['sem']-1;
        echo "<p id='check' align='center' style='font-size:26px;'>".$result['batch']." has successfully been depromoted!!</p>";
        }
        else if ($sem == 1)
        echo "<script>document.getElementById('error').innerHTML = 'Warning!! : You cannot Depromote the First semester students'</script>";
        else
		echo "<script>document.getElementById('error').innerHTML = 'Warning!! : You cannot Depromote Alumni'</script>";
		}
		$query1 = "UPDATE studinfo  set sem = $sem WHERE batch = '".$batch."'"; 
		mysqli_query($con,$query1) or die(mysqli_error($con));
		mysqli_close($con); 
	}
	?>
<table id="roll" align="center">
<form >
<tr><td>Enter the batch</td><td>:</td><td><input type="text" name"batch" id="no"></td></tr>
<tr><td align="right";><input type="button" id="btn1" value="Promote" ></td><td></td><td><input type="button" id="btn2" value="Depromote" ></td></tr>
</form>
</table>
<div id='loading' align="center" style='display: none'><img src="ajax-loader.gif" title="Loading" /></div>
<span color='red' align="center" id='error'></span>
<script src=" jquery-2.0.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
				  {
				   var that = $(this),val = that.val();
                   
				  $("#btn1").click( function()
								  {
								  var loadingdiv = document.getElementById('loading');
								  loadingdiv.style.display = "block";
								  $.ajax({
										 type:"GET",
										 url:"promote.php",
										 data:"batch="+document.getElementById("no").value+"&id="+1,
										 success: function(data)
										 {
										 var loadingdiv = document.getElementById('loading');
										 loadingdiv.style.display = "none";
										 var chang  = document.getElementById('check');
                                         $('#roll').hide();
								         $('#check').show();
										 $("#txtHint").html(data);
										 }
										 });
								  });
                    $("#btn2").click( function()
								  {
								  var loadingdiv = document.getElementById('loading');
								  loadingdiv.style.display = "block";
								  $.ajax({
										 type:"GET",
										 url:"promote.php",
										 data:"batch="+document.getElementById("no").value+"&id="+2,
										 success: function(data)
										 {
										 var loadingdiv = document.getElementById('loading');
										 loadingdiv.style.display = "none";
										 var chang  = document.getElementById('check');
                                         $('#roll').hide();
								         $('#check').show();
										 $("#txtHint").html(data);
										 }
										 });
								  });
										 
				});
</script>
<div id="txtHint" style="text-align:center;"></div>
</body>
</html>