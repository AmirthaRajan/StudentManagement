<?php
	$connection = mysql_connect('localhost', 'root', ''); 
	mysql_select_db('Aptitude');
	
	$query = "SELECT * FROM students where department = '$_POST[department]' and batch = '$_POST[batch]' and section='$_POST[section]' "; 
	$result = mysql_query($query);
	echo "<br/>";
	echo "<table border ='1' align='center'>"; 
	$i=1;
	while($row = mysql_fetch_array($result))
	{   
		echo "<tr><td>" . $i . "</td><td>" . $row['rollno'] . "</td><td>" . $row['username'] . "</td><td>" . $row['mark'] . "</td></tr>";
		$i++;
	}
	
	echo "</table>"; 
	echo "<br/><br/><br/>";
	echo "<div align='center'><label>Go Back : &nbsp;</label><a href='mark.php'><img src='back_button.gif'/></a><br/><label>Home : &nbsp;</label><a href='securedpage.php'><img src='home.png'></a></div>";	
	mysql_close(); 
?>