<?php
$connection = mysql_connect('localhost', 'root', ''); 
mysql_select_db('Aptitude');

$query = "SELECT * FROM questions"; 
$result = mysql_query($query);

echo "<table border ='1' >"; 

while($row = mysql_fetch_array($result)){   
	echo "<tr><td>" . $row['id'] . "</td><td>" . $row['question'] . "</td><td>" . $row['answer1'] . "</td><td>" . $row['answer2'] . "</td><td>" . $row['answer3'] . "</td><td>" . $row['answer4'] . "</td></tr>"; 
}

echo "</table>"; 

mysql_close(); 
	echo "Return to home Page";
	echo "<br/>";
	echo "<form action='index1.php'>
	<input type='submit' value='Home'>
	</form>";	
?>