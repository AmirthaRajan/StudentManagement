<?php
	
	session_start();
	
	if (!isset($_SESSION['username'])) 
	{
		header('Location: index.php');
	}
	
	$name=$_SESSION['username'];
	$rollno=$_SESSION['rollno'];
?>
<html>
<head>
<title>
Change Password
</title>
	<style>
	input[type=submit] {color:#0099FF;font-size: 18px;}
	body {
		background-image: url(backimg.jpg);background-size:cover;color:#019fde;
		}
	</style>
</head>
<body>

<table border="0" align="center">
<form method="post" action= "change.php" >

<tr><td>Old Password  </td><td>:</td><td><input type="password" name="oldpass" size="25"></td></tr>

<tr><td>New Password</td><td>:</td><td><input type="password" name="pass" size="25"></td></tr>

<tr><td>Confirm Password</td><td>:</td><td><input type="password" name="pass1" size="25"></td></tr>

<tr><td>&nbsp;</td><td>&nbsp;</td><td><input type="submit" value="Change"></td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><a href="securedpage.php"><img src="back_button.png"></a><td>&nbsp;</td></tr>

</form>
</table>
</body>
</html>