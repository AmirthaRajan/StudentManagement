<?php
	
	session_start();
	
	if (!isset($_SESSION['username'])) 
	{
		header('Location: index.php');
	}
	if (!isset($_SESSION['id'])) 
	{
		header('Location: index.php');
	}
	
	$name=$_SESSION['username'];
	$id=$_SESSION['id'];

?>
<html>
<head>
<title>Secured Page</title>
<style type="text/css">
<!--

.style5 {font-size: 26px}
b
{
font-size:28px;
}
body {
	background-image: url(background.jpg);
	background-color: #ECE9D8;
	background-repeat: no-repeat;
	background-size:cover;
}

-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body >
<?php echo "<div style='text-align:center'><h1>Welcome ". $_SESSION['username']."!</h1></div>"; 
	?>
<br/>
<?php 
	if ( $name != "administrator" )
	{
?>
<form action="../Aptitude/home.php">
<div align="center" style="margin-top:100px;"><label style="font-size:30px"><b>Take Your Test</b></label>&nbsp;<br/><input type="submit" value="Go"></div>
</form>
<br/>
<?php } ?>
<?php 
	if ( $name == "administrator")
	{
?>
<table align="center">
<tr>
<td style="font-size:20px;"><input type="radio" name="radioVal" value="aptitude" >Aptitude</td>
<td>&nbsp;</td>
<td style="font-size:20px;"><input type="radio" name="radioVal" value="student" >Student</td>
</tr>
</table>
<div class="ajax aptitude" style="font-size:20px;">
<table height="120" align="center">
<tr>
  <td>
    <span class="style5">
    <label><strong>Delete Record</strong></label>
     </span></td>
  <td> : </td><td><a href="deletestu.php"><img src="go.gif" ></a></td>
</tr>
<br/>
<tr>
  <td><span class="style5">
    <label><strong>View Registered Students</strong></label>
  </span></td>
  <td> : </td><td><a href="view1.php"><img src="go.gif" ></a></td>
</tr>
<br/>
<tr>
<td><label><span class="style5">
<strong>Edit Questions</strong></label></td>
<td> : </td><td><a href="../Aptitude/index1.php"><img src="go.gif" ></a></td>

</tr>
</span>
<br/>
<tr>
<td><label><span class="style5">
<strong>Register a Student</strong></label></td>
<td> : </td><td><a href="register.php"><img src="go.gif" ></a></td>
</tr>
</span>
<br/>
<tr>
<td><label><span class="style5">
<strong>View the Result</strong></label></td>
<td> : </td><td><a href="mark.php"><img src="go.gif" ></a></td>
<span class="style5">
</tr>
</span>
<br/>
<tr>
<td><label><span class="style5">
<strong>Change Your Password</strong></label></td>
<td> : </td><td><a href="changepwd.php"><img src="go.gif" ></a></td>
<span class="style5">
</tr>
</span>
</table>
</div>
<p>
</p>
<p><br/>
</p>
<div class="ajax student">
<table align="center">
<tr>
<td><label><span class="style5">
<strong>Go To Student Info</strong></label></td>
<td> : </td><td><a href="../student/index.php"><img src="go.gif" ></a></td>
<span class="style5">
</tr>
</table>
</div>

<div class="student aptitude">
<p align="center" style="margin-top:80px;"><a href="logout.php"><img src="logout.gif" style="opacity:0.7;"/></a></p>
</div>
<script src="jquery-2.0.2.min.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
					$('div.ajax').hide();
					});
$('input[type=radio][name=radioVal]').on('change', function () {
										 var that = $(this);
										 var value = that.val();
										 if(value == 'aptitude')
										 {
										 $('div.ajax').hide();
										 $('div.' + value ).show(); 
										 }
										 if(value == 'student')
										 {
										 $('div.ajax').hide();
										 $('div.' + value ).show();
										 }
										 });
</script>
<?php } ?>
</body>

</html>

