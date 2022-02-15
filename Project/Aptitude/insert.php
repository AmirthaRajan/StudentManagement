<?php 
	require_once 'config.php';
	$mysqli = new mysqli("localhost", "root", "", "Aptitude");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
?>
<html>
<head>
<meta http-equiv="Content-Type"  charset="utf-8"/>
<title>Insert Questions</title>
</head>
<body style="font-size: 35px; strong;" >
<style>
div
{
display:none;
}
input[type=submit] 
{
color:#0099FF;
	font-size: 20px;
}
body {
	font-size:33px;
	background-image: url(backimg.jpg);
	background-size:cover;
	background-repeat: no-repeat;
	color:#019fde;
}
hr { display: block; height: 1px;
border: 0; border-top: 1px solid black;
     padding: 0; }
</style>
<table border="0" style="padding-left:13%;padding-right:18%" align="ceneter" >
<?php 
	$result = $mysqli->query("SELECT id FROM questions ORDER BY id");
	$row_cnt = $result->num_rows;
	$rowscunt=$row_cnt+1;
	echo "<p style='text-align:center;'>Question Number ".$rowscunt."</p>";
?>
<form style=" line-height: 20px;" method="post" action="insertsql.php" enctype="multipart/form-data">

<tr>
<td style="font-size: 30px;">Question </td><td>:</td>
<td>

<input type="file" name="image" id="image">
<textarea style="width: 547px; height: 137px;" name="question" ></textarea>
</td>
</tr>

<tr><td style="font-size: 30px;">Answer1 </td><td>:</td>
<td><textarea style="width: 432px; height: 159px;" name="answer1" ></textarea></td>
<td><input type="file" name="image1" id="image">
</td></tr>

<tr><td style="font-size: 30px;">Answer2 </td><td>:</td>
<td><textarea style="width: 432px; height: 159px;" name="answer2" ></textarea></td>
<td><input type="file" name="image2" id="image">
</td></tr>

<tr><td style="font-size: 30px;">Answer3 </td><td>:</td>
<td><textarea style="width: 432px; height: 159px;" name="answer3" ></textarea></td>
<td><input type="file" name="image3" id="image">
</td></tr>

<tr><td style="font-size: 30px;">Answer4 </td><td>:</td>
<td><textarea style="width: 432px; height: 159px;" name="answer4" ></textarea></td>
<td><input type="file" name="image4" id="image"></td></tr>

<tr><td style="font-size: 30px;">Answer </td><td>:</td>
<td><input type="text" name="answer" /></td></tr>

<tr><td style="font-size: 30px;">Submit </td><td>:</td>
<td><input type="submit" value="Insert" /></td></tr>

<tr><td style="font-size:30px;">Home  </td><td>:</td><td>
<a style=" vertical-align: bottom; line-height: 14px;" href="index1.php"><img src="home.png"/></a></td></tr>
</script>
</form>
</table>
</body>
</html>
