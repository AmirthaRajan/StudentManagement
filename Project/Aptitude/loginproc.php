<?php
	
	
	session_start();
	
	include('config.php');
	
	$login = mysql_query(" SELECT * FROM students WHERE rollno = '$_POST[rollno]' and password = '$_POST[password]' ");
	$sql=mysql_num_rows($login);
	$query=mysql_fetch_assoc($login);
		
		$dt=$query['date'];
		$_SESSION['rollno'] = $_POST['rollno'];
		$_SESSION['rollno'] = $query['rollno'];
	
		date_default_timezone_set('Asia/Kolkata');
		$date = date("Y-m-d h:i:s");
		$difference = abs(strtotime($date)-strtotime($dt));
		$hours = floor($difference / (60*60));
	
	if($hours < 24 && $query['username'] != "administrator")
	{
		echo "<h1> You can login only once a day </h1><br/><h3> ComeBack Tomorrow </h3>";
	}
	else
	{
	if ($sql) 
	{
		$_SESSION['username'] = $query['username'];
		if($query['id'] < 4 )
		{ 
			if(1 == $query['id'])
				$_SESSION['id']=1;
			elseif(2 == $query['id'])
				$_SESSION['id']=2;
			else
				$_SESSION['id']=3;
		}
		else
		{
		$_SESSION['id']=(($query['id'])%4);
		}
	    $time=mysql_query("UPDATE students SET date = NOW() WHERE username ='$_SESSION[username]' ");
		header('Location: securedpage.php');
	}
	else
	{
		header('Location: index.php');
	}
	}

?>