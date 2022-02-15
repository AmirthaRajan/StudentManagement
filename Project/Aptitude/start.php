<?php require_once 'config.php';?>
<?php
	
	session_start();
	
	if (!isset($_SESSION['username'])) 
	{
		header('Location: index.php');
	}
	
	?>
<!DOCTYPE html>
<html>
<head>
<title>Test</title>
<meta http-equiv="Content-Type" content="charset=utf-8"/>
<link rel='stylesheet' href='style.css'/>
</head>
<style>
@font-face 
{
  font-family:DAEMONES;
  src: url(DAEMONES.TTF);	
}
p
{
	font-family:DAEMONES;
	font-size:42px;
	color:#019fde;
	text-align:center;
	font-weight:bold;
}
html,body,h1,span,div {
	font-size:30px;
	background-image: url(background.jpg);
	background-size:cover;
	background-repeat: no-repeat;
}
form 
{
display: inline-block;
text-align:relative;
}
</style>
<body>
<p>Aptitude Test</p>
<div id="demo1" class="demo" style="text-align:center;font-size: 25px;position:relative;"><span style="font-size:35px;font:bold;color:#019fde;" id="timer"></span></div>
<?php 
	if($_SESSION['username'] != "administrator")
	{
		if(1 == $_SESSION['id'])
		{$response=mysql_query("select * from questions");} 
		elseif(2 == $_SESSION['id'])
		{$response=mysql_query("select * from questions1");}
		elseif(3 == $_SESSION['id'])
		{$response=mysql_query("select * from questions2");}
		else
		{$response=mysql_query("select * from questions3");}
	}
	else
	{
	$response=mysql_query("select * from questions"); 
	}
?>

<form method='post' id='quiz_form' enctype="multipart/form-data">
<?php while($result=mysql_fetch_array($response)){ ?>
<div id="question_<?php echo $result['id'];?>" class='questions'>
<h2 id="question_<?php echo $result['id'];?>">
<?php echo $result['id'].".".$result['question']."<br/>"; ?><br/>
<?php
	if($result['image'] != null)
	{
		echo '<div style="position:relative;left:20%;"><img src="data:image/jpeg;base64,' . base64_encode( $result['image'] ) . '" /></div>'; 
	}
?>
<br/>
</h2>
<div class='align'>
<input type="radio" value="1" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>' >
<label id='ans1_<?php echo $result['id'];?>' for='answer1_<?php echo $result['id'];?>'><?php echo $result['answer1'];
	if($result['image1'] != null)
	{
		echo '<div style="position:relative;"><img src="data:image/jpeg;base64,' . base64_encode( $result['image1'] ) . '" /></div>'; 
	}
	?></label>
<br/>
<input type="radio" value="2" id='radio2_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>' >
<label id='ans2_<?php echo $result['id'];?>' for='answer2_<?php echo $result['id'];?>'><?php echo $result['answer2'];
	if($result['image2'] != null)
	{
		echo '<div style="position:relative;"><img src="data:image/jpeg;base64,' . base64_encode( $result['image2'] ) . '" /></div>'; 
	}
	?></label>
<br/>
<input type="radio" value="3" id='radio3_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>' >
<label id='ans3_<?php echo $result['id'];?>' for='answer3_<?php echo $result['id'];?>'><?php echo $result['answer3'];
	if($result['image3'] != null)
	{
		echo '<div style="position:relative;"><img src="data:image/jpeg;base64,' . base64_encode( $result['image3'] ) . '" /></div>'; 
	}
	?></label>
<br/>
<input type="radio" value="4" id='radio4_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>' >
<label id='ans4_<?php echo $result['id'];?>' for='answer4_<?php echo $result['id'];?>'><?php echo $result['answer4'];
	if($result['image4'] != null)
	{
		echo '<div style="position:relative;"><img src="data:image/jpeg;base64,' . base64_encode( $result['image4'] ) . '" /></div>'; 
	}
	?></label>
<input type="radio" checked='checked' value="5" style='display:none' id='radio4_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'>
<br/>
</div>
<br/>
<input type="button" id='next<?php echo $result['id'];?>' value='Next!' name='question' class='butt'/>
</div>
<?php }?>
</form>
<div id='result' style="center">
<img src='funny.gif' alt='Results'/>
<br/>
</div>
<br/>
<div id="demo1" class="demo" style="text-align:center;font-size: 25px;position:relative;"><span style="font-size:35px;font:bold;color:#0000000;" id="timer1"></span></div>
<br/>
<script src="jquery-2.0.2.min.js"></script>
<script type="text/javascript">
function submit()
{
	$.ajax({
		   type: "POST",
		   url: "ajax.php",
		   data: $('form').serialize(),
		   success: function(msg) 
		   {
		   $("#quiz_form,#demo1").addClass("hide");
		   $('#result').show();
		   $('#result').append(msg);
		   }
		   });
}
var mins = 45; 
var secs = mins * 60;
var currentSeconds = 0;
var currentMinutes = 0;
var countno=0;
setTimeout('Decrement()',1000);
function Decrement() 
{
	currentMinutes = Math.floor(secs / 60);
	currentSeconds = secs % 60;
	if(countno == 2699)
	{
		submit();
	}
	if(currentSeconds <= 9) currentSeconds = "0" + currentSeconds;
	secs--;
	countno++;
	document.getElementById("timer").innerHTML = currentMinutes + ":" + currentSeconds;
	document.getElementById("timer1").innerHTML = currentMinutes + ":" + currentSeconds;
	if(secs !== -1) setTimeout('Decrement()',1000);
}
</script>
<script>
$(document).ready(function()
				  {
				  var steps = $('form').find(".questions");
				  var count = steps.size();
				  steps.each(function(i)
							 {
							 hider=i+2;
							 if (i == 0) 
							 { 	
							 $("#question_" + hider).hide();
							 createNextButton(i);
							 }
							 else if(count==i+1)
							 {
							 var step=i + 1;
							 $("#next"+step).on('click',function()
												{
												submit();                
												});
							 }
							 else{
							 $("#question_" + hider).hide();
							 createNextButton(i);
							 }
							 });
				  function createNextButton(i)
				  {
				  var step = i + 1;
				  var step1 = i + 2;
				  $('#next'+step).on('click',function()
									 {
									 $("#question_" + step).hide();
									 $("#question_" + step1).show();
									 });
				  }
				  });
</script>
</body>
</html>