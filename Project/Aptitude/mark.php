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
<title>Aptitude Results</title>
</head>
<body>
<a href="securedpage.php"><img src="back_button.png"></a>
<div align="center" style="margin-top:200px;">
<form method="post" action= "viewmark.php" >
<div style="font-size:30px;">
Department : <select name="department" >
<option value="IT">IT</option>
<option value="CSE">CSE</option>
<option value="ECE">ECE</option>
<option value="EEE">EEE</option>
<option value="MEC">MEC</option>
</select>
<br />
Year/Batch : <select name="batch" >
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
</select>
<br />
Section : <select name="section">
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="D">D</option>
</select>
<br />
<input type="submit" value="view">
</div>
</form>
</div>
</body>
</html>