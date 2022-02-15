<!DOCTYPE html>
<html>
<head runat="server">
<title>
Home
</title>
<style type="text/css">
@font-face
{
src:url(AvQest.ttf);
font-family:lord;
}
.bg:hover
{
color:#910000;
}

#bg1
{
font-family:lord;
opacity:0.65;
color:black;
}
#bg
{ 
background-image: url(logo.jpg);
backgroung-position:left;
background-repeat: no-repeat;
background-size:200px 200px;
}
#bg1
{
color:black;
opacity:1;
background-image: url(iso.jpg);
background-position:right;
background-repeat: no-repeat;
background-size:200px 200px;
}
nav ul ul 
{
display: none;
}

nav ul li:hover > ul 
{
	display: block;
}
nav ul 
{
	background: #efefef; 
	background: linear-gradient(top, #efefef 0%, #bbbbbb 100%);  
	background: -moz-linear-gradient(top, #efefef 0%, #bbbbbb 100%); 
	background: -webkit-linear-gradient(top, #efefef 0%,#bbbbbb 100%); 
	box-shadow: 0px 0px 9px rgba(0,0,0,0.15);
	padding: 0 20px;
	border-radius: 10px;  
	list-style: none;
	position: relative;
	display: inline-table;
	
}
nav ul:after 
{
	content: ""; clear: both; display: block;
}
nav ul li 
{
	float: left;
}
nav ul li:hover 
{
	background: #4b545f;
	background: linear-gradient(top, #4f5964 0%, #5f6975 40%);
	background: -moz-linear-gradient(top, #4f5964 0%, #5f6975 40%);
	background: -webkit-linear-gradient(top, #4f5964 0%,#5f6975 40%);
}
nav ul li:hover a 
{
	color: #fff;
}
nav ul li a 
{
	display: block; padding: 25px 40px;
	color: #757575; text-decoration: none;
}
nav ul ul 
{
	background: #5f6975; border-radius: 2px; padding: 0;
	position: absolute; top: 100%;
}
nav ul ul li 
{
	float: none; 
	border-top: 1px solid #6b727c;
	border-bottom: 1px solid #575f6a;
	position: relative;
}
nav ul ul li a 
{
	padding: 15px 40px;
	color: #fff;
}	
nav ul ul li a:hover 
{
	background: #4b545f;
}
nav ul ul ul 
{
	position: absolute; left: 100%; top:0;
}
</style>
<?php
	session_start();
	if (!isset($_SESSION['username'])) 
	{
		header('Location: ../Aptitude/index.php');
	}
	include 'config.php';
?>
</head>
<body >

<div id="bg1" style="text-align:center;position:relative;font-size:26px">
<p id="bg" class="bg">Panimalar Institute Of Technology<br/>
(A Christian Minority Institution)<br/>
(Jaisakthi Educational Trust)<br/>
NO.391,BangaloreTrunkRoad,Varadharajapuram,Nasarethpettai,<br/>
Poonamallee,Chennai-600123<br/>
INFORMATION TECHNOLOGY</p>
</div>
<div align="center">
<nav>
<ul>
		<li><a class="links" value="table" name="hmVal" id="select"><b>HOME</b></a>
		   <ul>
		  		<li><a href="index.php" >Student</a></li>
				<li><a href="../Aptitude/securedpage.php" >Appitude</a></li>
				<li><a href="../Aptitude/logout.php" > Logout</a></li>
			 </ul>
		</li>
		<li><a class="links" value="student" name="stuVal" id="select"><b>STUDENT</b></a>
			<ul>
				
				<li><a href="#" value="stuadd" name="stuadd" id="stu">Add</a></li>
				<li><a href="#" value="stuedt" name="stuedt" id="stu">Edit</a></li>
				<li><a href="#" value="sturmv" name="sturmv" id="stu">Remove</a></li>
				<li><a href="#" value="stuvew" name="stuvew" id="stu">View</a></li>
				<li><a href="#" value="stupmt" name="stupmt" id="stu">Promote</a></li>
				
			</ul>
		</li>
		<li><a class="links" value="attend" name="atnVal" id="select"><b>ATTENDANCE</b></a>
			<ul>
				
				<li><a href="#" value="atnadd" name="atnadd" id="atn">Enter</a></li>
				<li><a href="#" value="atnedt" name="atnedt" id="atn">Change</a></li>
				<li><a href="#" value="atnvew" name="atnvew" id="atn">View Days</a></li>
				<li><a href="#" value="prdvew" name="prdvew" id="atn">View Periods</a></li>
			
			</ul>
		</li>
		<li><a class="links" value="exam" name="exmVal" id="select"><b>EXAM</b></a>
			<ul>
			
				<li><a href="#" value="exmadd" name="exmadd" id="exm">Enter Exam / Mark</a></li>
				<li><a href="#" value="exmedt" name="exmedt" id="exm">Edit Exam / Mark</a></li>
				<li><a href="#" value="exm" name="exm" id="exm">View Results</a>
				<ul>
				<li><a href="#" value="exmvew" name="exmvew" id="exm">Exam Result</a></li>
				<li><a href="#" value="semexm" name="semexm" id="exm">Semester Result</a></li>
				</ul>
				</li>
			</ul>
		</li>
		<li><a class="links" value="subject" name="sbjVal" id="select"><b>SUBJECTS</b></a>
			<ul>
				
				<li><a href="#" value="sbjadd" name="sbjadd" id="sbj">Add</a></li>
				<li><a href="#" value="sbjedt" name="sbjedt" id="sbj">Edit</a></li>
				<li><a href="#" value="sbjvew" name="sbjvew" id="sbj">View</a></li>
					
			</ul>
		</li>
		<li><a class="links" value="table" name="tblVal" id="select"><b>TIMETABLE</b></a>
		   <ul>
				<li><a href="#" value="tbladd" name="tbladd" id="tbl" >Add Timetable</a></li>
				<li><a href="#" value="tbledt" name="tbledt" id="tbl" >Edit Timetable</a></li>
				<li><a href="#" value="tblvew" name="tblvew" id="tbl" >View Timetable</a></li>
		   </ul>
		</li>
		<li><a class="links" value="table" name="tblVal" id="select"><b>OTHER</b></a>
		   <ul>
				<li><a href="#" value="otrmrk" name="mrkxls" id="otr" >Mark XL</a></li>
				<li><a href="#" value="otrstd" name="stdxls" id="otr" >Student XL</a></li>
				<li><a href="about.php" value="otrabt" name="otrabt" id="otr" >About</a></li>
		   </ul>
		</li>
</ul>	
</nav>
</div>
<br/><br/><br/>
<script src="jquery-2.0.2.min.js"></script>
<script>

 $(document).ready(function()
				  {				  				 			   
				   $("a[name=stuadd]").on('click',function()
											 {
											 $.ajax({url:"addstu.php",success:function(result)
													{
													
													$("#spn").html(result);
													}
													});
											 });
				   $("a[name=stuedt]").click(function()
											 {
											 $.ajax({url:"edtstu.php",success:function(result)
													{
													
													$("#spn").html(result);
													}
													});
											 });
				   $("a[name=sturmv]").click(function()
											 {
											 $.ajax({url:"rmvstu.php",success:function(result)
													{
													
													$("#spn").html(result);
													}
													});
											 });
				   $("a[name=stuvew]").click(function()
											 {
											 $.ajax({url:"vewstu.php",success:function(result)
													{
													
													$("#spn").html(result);
													}
													});
											 });
				   $("a[name=stupmt]").click(function()
											 {
											 $.ajax({url:"promote.php",success:function(result)
													{
													
													$("#spn").html(result);
													}
													});
											 });
				   $("a[name=atnadd]").click(function()
											 {
											 $.ajax({url:"addatn.php",success:function(result)
													{
													
													$("#spn").html(result);
													}
													});
											 });
				   $("a[name=atnedt]").click(function()
											 {
											 $.ajax({url:"edtatn.php",success:function(result)
													{
													
													$("#spn").html(result);
													}
													});
											 });
				   $("a[name=atnvew]").click(function()
											 {
											 $.ajax({url:"vewatn.php",success:function(result)
													{
													
													$("#spn").html(result);
													}
													});
											 });
				   $("a[name=prdvew]").click(function()
											 {
											 $.ajax({url:"period.php",success:function(result)
													{
													
													$("#spn").html(result);
													}
													});
											 });
				   $("a[name=exmadd]").on('click',function()
											 {
											 $.ajax({url:"addexm.php",success:function(result)
													{
													
													$("#spn").html(result);
													}
													});
											 });
				   $("a[name=exmedt]").on('click',function()
											 {
											 $.ajax({url:"edtexm.php",success:function(result)
													{
													
													$("#spn").html(result);
													}
													});
											 });
				   $("a[name=exmvew]").on('click',function()
											 {
											 $.ajax({url:"vewexm.php",success:function(result)
													{
													$("#spn").html(result);
													}
													});
											 });
				   $("a[name=semexm]").on('click',function()
											 {
											 $.ajax({url:"semexm.php",success:function(result)
													{
													$("#spn").html(result);
													}
													});
											 });
				   $("a[name=sbjadd]").click(function()
											 {
											 $.ajax({url:"addsbj.php",success:function(result)
													{
													
													$("#spn").html(result);
													}
													});
											 });
				   $("a[name=sbjedt]").click(function()
											 {
											 $.ajax({url:"edtsbj.php",success:function(result)
													{
													
													$("#spn").html(result);
													}
													});
											 });
				   $("a[name=sbjvew]").click(function()
											 {
											 $.ajax({url:"vewsbj.php",success:function(result)
													{
													
													$("#spn").html(result);
													}
													});
											 });
				   $("a[name=tbladd]").click(function()
				  							{
					   						$.ajax({url:"addtbl.php",success:function(result)
					   								{
						   
						   							$("#spn").html(result);
					  								 }
					   								});
				   							});
				   $("a[name=tbledt]").click(function()
											 {
											 $.ajax({url:"edttbl.php",success:function(result)
													{
													
													$("#spn").html(result);
													}
													});
											 });
				   $("a[name=tblvew]").click(function()
											 {
											 $.ajax({url:"vewtbl.php",success:function(result)
													{
													
													$("#spn").html(result);
													}
													});
											 });
					$("a[name=mrkxls]").click(function()
											 {
											 $.ajax({url:"Excel/mrkxls.php",success:function(result)
													{
													
													$("#spn").html(result);
													}
													});
											 });
					$("a[name=stdxls]").click(function()
											 {
											 $.ajax({url:"Excel/stdxls.php",success:function(result)
													{
													
													$("#spn").html(result);
													}
													});
											 });
					$("a[name=otrabt]").click(function()
											 {
											 $.ajax({url:"about.php",success:function(result)
													{
													
													$("#spn").html(result);
													}
													});
											 });						 
			});
</script>

<span id="spn"></span>
</body>
</html>