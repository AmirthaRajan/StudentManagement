<?php
	require_once 'config.php';
	session_start();
	?>
<html>
<head><title>
Passwordchange
</title>
</head>
<style >
	input[type=submit] {color:#0099FF;font-size: 18px;}
	p
	{
		font-size='30px';
		align='center';
	}
	body 
	{
		background-image: url(backimg.jpg);background-size:cover;color:#019fde;
	}
</style>
<body>
<?php
	
	if (!isset($_SESSION['username'])) 
	{
		header('Location: index.php');
	}
	
	$con=mysqli_connect("localhost","root","","Aptitude");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$login = mysql_query(" SELECT * FROM students WHERE rollno = ".$_SESSION['rollno']." ");
@	$sql=mysql_num_rows($login);
@	$query=mysql_fetch_assoc($login);
	$_SESSION['rollno'] = $query['rollno'];

		if($query['password'] != @ $_POST['pass'] || !$sql)
		{ 
			echo "<br/>";
			echo "<b><p align='center'>Re-Enter Your Password</p></b>";
			echo "<form action = 'changepwd.php' ><div align='center'><input type='submit' value='Back' /></div></form>";

		}
		else
		{
		$upd="UPDATE students SET password = ".$_POST['pass']." WHERE rollno= ".$_SESSION['rollno']." ";
		$res=mysql_query($upd) or die(mysql_error());
		echo " <br/><b><p> You Have Successfully changed the password</p></b>";
		echo " <form action='securedpage.php'><br/><p>Go Home</p></b><br/><input type='submit' value='Home' align='center'></form>";
		}

 
?>
		</body>
</html>