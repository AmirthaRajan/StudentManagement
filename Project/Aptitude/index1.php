<?php
	
	session_start();
	
	$name=$_SESSION['username'];
	
	if (!isset($_SESSION['username'])) 
	{
		header('Location: index.php');
	}
	if ( $name != "administrator")
	{
		echo "<h1><p>Access Denied</p></h1><h3>Only Administrator can assess this page</h3>";

	}
	else
	{
?>

<html>
<head>
<title>
Home Page
</title>
<style type="text/css">
<!--
body {
	background-repeat: no-repeat;
	background-attachment:fixed;
	background-position:center; 
	background-size: cover;
}
body.td
{
	font-weight: bold;
	font-size: 30px;
}
	
-->
</style>
</head>
<body background="background.jpg">
<h1 align="center" style="color:#0099FF; font-size: 36px;" >Welcome to Aptitude Test</h1>
<h3 align="center" style="margin-top:130px; font-size: 33px;">Select your option to alter the table</h3>
<table align="center" strong style="font-size: 30px;">
<tr>

<td><strong><label>Clear the table</label></strong></td><td>:</td><td><a href="clear.php"><img src="go.gif" ></td>
</tr>
<br/><tr>

<td><label><strong>Insert</strong></label></td><td>:</td><td><a href="insert.php"><img src="go.gif" ></td>
</tr>
<tr>

<td><strong><label>Copy to other tables</label></strong></td><td>:</td><td><a href="rand.php"><img src="go.gif" ></td>
</tr>
<br/><tr>

<td><label><strong>Delete</strong></label></td><td>:</td><td><a href="delete.php"><img src="go.gif" ></td>
</tr>
<tr>

<td><strong><label>View Table</label></strong></td><td>:</td><td><a href="view.php"><img src="go.gif" ></td>
</tr>
<tr>

<td><strong><label>Aptitude Test</label></strong></td><td>:</td><td><a href="start.php"><img src="go.gif" ></td>
</tr>
<tr><td>&nbsp;</td></tr><tr>

<td><strong><label>Logout</label></strong></td><td>:</td><td><a href="logout.php"><img src="logout.gif" style="opacity:0.6"></td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td><a href="securedpage.php"><img src="back_button.gif"/></a></td></tr>
</tabel>
  </body>
</html>
<?php } ?>
