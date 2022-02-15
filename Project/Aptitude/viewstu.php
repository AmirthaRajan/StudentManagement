<?php
	$connection = mysql_connect('localhost', 'root', ''); 
	mysql_select_db('Aptitude');
	
	$query = "SELECT * FROM students where department = '$_POST[department]' and batch = '$_POST[batch]' and section='$_POST[section]' ";
	$result = mysql_query($query);
	echo "<br/>";
	echo "<div align='center' style='margin-top:100px;'><table border ='1'>"; 
	
	while($row = mysql_fetch_array($result))
	{   
		echo "<tr><td>" . $row['id'] . "</td><td>" . $row['rollno'] . "</td><td>" . $row['username'] . "</td></tr>";  
	}
	
	echo "</table>"; 
	
	mysql_close(); 
	echo "<br/><a href='securedpage.php'><img src='back_button.png'/></a></div>";
	?>