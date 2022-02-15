<?php
	
	session_start();
	
	if (!isset($_SESSION['username'])) 
	{
		header('Location: index.php');
	}
	
	$name=$_SESSION['username'];
?>
<html>
<head>
<title>Delete Record</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style type="text/css">
<!--
input[type=submit] 
{
color:#0099FF;
font-size: 18px;
}
body {
	background-image: url(backimg.jpg);
	background-size:cover;
	background-repeat: no-repeat;
	color:#019fde;
}
-->
</style></head>
<body>
<?php
	if ( $name != "administrator")
	{
		echo "<h1><p>Access Denied</p></h1><h3>Only Administrator can assess this page</h3>";
		
	}
    else
	{
?>

<div style="line-height: 400px; text-align:center; vertical-align:middle; ">
<form style="display: inline-block; vertical-align: middle; line-height: 14px; " method="post" action="deleterec.php">
<br/>
<h1>Delete a Question</h1>
<br/>
<strong>
<div style="font-size:30px;">
<br/>
Enter the ID of the Question :<input type="text" name="id" >
<input type="submit"  value="Delete">
</div>
</form>
<a style="display: inline-block; vertical-align: bottom; line-height: 14px;" href="index1.php"><img src="back_button.gif"/></a>
</strong>
</div>
<?php } ?>
</body>
</html>

