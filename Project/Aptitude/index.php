<?php
	include 'config.php';
	
	session_start();
	
	if (isset($_SESSION['username'])) 
	{
		header('Location: securedpage.php');
	}
	
?>
<html>

<head>
<title>Login</title>
<style type="text/css">
html
{
		background:url(alienware.jpg) no-repeat center;
		background-size:cover;
}

<!--
.style8 {
	font-family: Vivaldi, "Estrangelo Edessa";
	font-weight: bold;
}
.style9 {font-size: 24px}
.style10 {
	font-weight: bold;
	font-size: 36px;
	font-family: "Rockwell Extra Bold";
	color: #501D1E;
	margin-top: 30%;
	margin-left: 40%;
}
.style11 {font-size: 24px; font-family: Georgia, "Times New Roman", Times, serif; }
-->
</style>
</head>

<body >

<h3 class="style10">Login</h3>


<div style="margin-left:35%;">
  <table border="0">
    <form action="loginproc.php" method="POST" class="style8">
        <tr><td width="67" class="style11"><strong>Rollno</strong>  </td>
        <td width="10" class="style9">:</td>
        <td width="150" class="style9">
          <input type="text" name="rollno" size="25">        </td>
        </tr>
          
        <tr><td height="26" class="style11"><strong>Password</strong></td>
        <td class="style9">:</td><td class="style9">
          <input type="password" name="password" size="25">
        </td>
        </tr>
          
        <tr><td>&nbsp;</td><td>&nbsp;</td><td class="style9">
          <input type="submit" value="Login" style="height:30px;width:80px; color=#0000ff;" >
        </td>
        </tr>
    </form>
  </table>
</div>
</body>

</html>