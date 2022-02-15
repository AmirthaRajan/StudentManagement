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
<title>Registration Form</title>
</head>
<style>
.error 
{
color: #FF0000;
}
input[type=submit] 
{
color:#0099FF;
font-size: 18px;
}
body {
	font-size:33px;
	background-image: url(backimg.jpg);
	background-size:cover;
	background-repeat: no-repeat;
	color:#019fde;
}
-->
</style>
<body>
<?php 
if ( $name != "administrator")
{
	echo "<h1><p>Access Denied</p></h1><h3>Only Administrator can assess this page</h3>";
	
}
else
{
?>
<table border="0" style="padding-left:30%;padding-right:25%" align="middle">
<form method="post" action= "registration.php" >
<tr><td><h1>Registration Form</h1></td></tr>
<br/>
<tr><td style="font-size:26px;"><p><span class="error">* required field.</span></p></td></tr>
<tr><td style="font-size:30px;">Name  </td><td>:</td><td><input type="text" name="username" ><span class="error">* </span></td></tr>

<tr><td style="font-size:30px;">Rollno  </td><td>:</td><td><input type="text" name="rollno"><span class="error">* </span></td></tr>

<tr><td style="font-size:30px;">Password  </td><td>:</td><td><input type="password" name="password"><span class="error">* </span></td></tr>

<tr><td style="font-size:30px;">Department  </td><td>:</td><td><select name="department" >
<option value="IT">IT</option>
<option value="CSE">CSE</option>
<option value="ECE">ECE</option>
<option value="EEE">EEE</option>
<option value="MEC">MEC</option>
</select></td></tr>
<tr><td style="font-size:30px;">Year/Batch  </td><td>:</td><td><select name="batch" >
<option value="2010">2010</option>
<option value="2011">2011</option>
<option value="2012">2012</option>
<option value="2013">2013</option>
<option value="2014">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
</select></td></tr>
<tr><td style="font-size:30px;">Section  </td><td>:</td><td><select name="section" >
<option value="">-</option>
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="D">D</option>
</select></td></tr>
<br/>
<tr><td><hr></td><td><hr></td><td><hr></td></tr>
<tr><td style="font-size:30px;">Submit to Register  </td><td>:</td><td><input type="submit" value="Register"></td></tr>
</form>

<?php 
	
 } 
?> 
<tr><td><hr></td><td><hr></td><td><hr></td></tr>

<tr><td style="font-size:30px;">Home  </td><td>:</td><td><a style="display: inline-block; vertical-align: bottom; line-height: 14px;" href="securedpage.php"><img src="home.png"/></td></tr>
</table>
</body>
</html>