<?php require_once 'config.php';
	
	session_start();
	
	if (!isset($_SESSION['rollno'])) 
	{
		header('Location: index.php');
	}
	if (!isset($_SESSION['username'])) 
	{
		header('Location: index.php');
	}
	
	if($_SESSION['username'] != "administrator")
	{
		if(1 == $_SESSION['id'])
		{$query=mysql_query("select * from questions");} 
		elseif(2 == $_SESSION['id'])
		{$query=mysql_query("select * from questions1");}
		elseif(3 == $_SESSION['id'])
		{$query=mysql_query("select * from questions2");}
		else
		{$query=mysql_query("select * from questions3");}
	}
	else
	{
		$query=mysql_query("select * from questions"); 
	}
	$i=1;
	$right_answer=0;
	$wrong_answer=0;
	$unanswered=0;
	while($response=mysql_fetch_array($query))
	{      
		if($response['answer']==$_POST["$i"])
		{
			$right_answer++;	
		}
		else if($_POST["$i"]==5)
		{
			
			$unanswered++;
		}
		else
		{
			
			$wrong_answer++;
		}
		$i++;
	}
	echo "<div id='answer'><br/><br/><br/>";
	echo " <span class='highlight'>Right Answer : </span>";
	echo "<span class='high'>". $right_answer."</span><br>";
	echo " <span class='highlight'>Wrong Answer  : </span>";
	echo "<span class='high'>". $wrong_answer."</span><br>";
	echo " <span class='highlight'>Unanswered Question  : </span>";
	echo "<span class='high'>". $unanswered."</span><br/><br/><br/>";
	echo "<br/><form action='logout.php'><input type='submit' value='Logout' class='butt' style='margin-left:200px;'></form>" ;
	$sql="UPDATE students SET mark = '$right_answer' WHERE rollno='$_SESSION[rollno]' ";
	$res=mysql_query($sql) or die(mysql_error());
	echo "</div>";
	?>