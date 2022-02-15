<?php require_once 'config.php'; ?>
<?php
	
	session_start();
	
	if (!isset($_SESSION['username'])) 
	{
		header('Location: index.php');
	}
	
?>
<html>
<head>
<title>
</title>
<style type= "text/css">
body
{
	font-size:28px;
}
p
{
font-size:20px;
}
.run
{
width:50px;
height:5px;
background:red;
position:relative;
animation:myfirst 3s;
animation-iteration-count:infinite;
}
.run1
{
width:50px;
height:5px;
background:red;
position:relative;
animation:myfirst1 3s;
animation-iteration-count:infinite;
}
@keyframes myfirst
{
0%   {background:red; left:0px; top:0px;}
25%  {background:yellow; left:300px; top:0px;}
50%  {background:blue; left:600px; top:0px;}
75%  {background:green; left:1000px; top:0px;}
100% {background:red; left:1500px; top:0px;}
}
@keyframes myfirst1
{
0%   {background:red; left:1500px; top:0px;}
25%  {background:yellow; left:1000px; top:0px;}
50%  {background:blue; left:600px; top:0px;}
75%  {background:green; left:300px; top:0px;}
100% {background:red; left:0px; top:0px;}
}

.container
{
	padding: 10px;
	border : 2px solid  #f00000;
}
.green
{
    color: #0ccf4a;
}
.gray
{
color: #606060;
}
.instruction
{
    padding-left: 15px;
    background-position: left;
    background-repeat: no-repeat;
    color: #424242;        
}
.rightinfo
{
    padding: 15px;
}

.rightinfo *
{
    font-family: Tahoma, Verdana, sans-serif;
    font-size: 12px;
}
.tbl-menu *
{
	font-size: 11px;
}

.tbl-menu td
{
	padding: 4px;
	font-size: 11px;
	font-weight: bold;
}

.tbl-menu td.normal
{
	padding: 5px;  
	background-repeat: repeat-x;
	border-right : 1px solid #f00000; 
	border-bottom : 1px solid #f00000;  
}

.tbl-menu td.current
{
	border-bottom: 1px; 
	border-right : 1px solid #f00000;
	border-top : 1px solid #f00000;
	border-left : 1px solid #f00000; 
	background-repeat: repeat-x; 
}

.tbl-menu td a.menu
{
	font-family: Verdana, Tahoma, sans-serif;
	font-size: 11px;
    color: #f00000;
	font-weight: bold;
	padding-right: 10px;
	padding-left: 10px;
	text-decoration: none; 
}

.tbl-menu td a.menu:hover
{
color: #a14242;
}
</style>
</head>
<body>
<form name="start" method="post" action="start.php" >
<table class="tbl-menu" cellpadding="0" cellspacing="0" border="0" style="margin: 0px">
<tr>
<td  class="current" nowrap="nowrap" ><a class="menu jq-menu" href="javascript: void(0);">Aptitude Test</a></td>
</tr>
</table>
<div class="container"> 
        <table cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td width="60%" valign="top"> 
                <div id="divInitiator" style="padding:25px; padding-top:5px;" align="center">
                     <div align="left">
          <p class="green" style="font-size:15px; font-familty:monotype corsiva , sans-serif;"><b>Instruction:</b></p>
          <p class="instruction">Total number of questions : <b>35</b>.</p>
          <p class="instruction">Time alloted : <b>45</b> minutes.</p>
          <p class="instruction">Each question carry 1 mark, no negative marks.</p>
                     <input type="submit" value=" Start Test " id="btnStartTest" onClick="a.php" />
                     </div>
                </div>
</div>
             <td class="rightinfo" width="40%" valign="top">
                <div style="width:100%; padding-left: 10px; border-left:1px dashed #ccc;">
                   <table class="gray" cellspacing="0" cellpadding="4" style="border: 2px solid #f2f2f2" width="100%">
                    <tr><td bgcolor="#f2f2f2"><b>Note:</b></td></tr>
                    <tr>
                        <td>
                            <ul>
                            <li style="padding-bottom:5px">Click the 'Submit Test' button given in the bottom of this page to Submit your answers.</li>
                            <li style="padding-bottom:5px">Test will be submitted automatically if the time expired.</li>
                            <li>Do not refresh the page or the session will expire.</li>
                            </ul>
						</td>
					 </tr>
					 </td>
					 </tr>
                  </table>
				  
                    
					<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                </div>
				<tabel>
<tr><td>
<p align="center" style="padding-left:500px;"><img src="good_luck_09.gif" alt="" width="275" height="220"><img src="bth_SmileyGoodLuck.gif" alt="" width="90" height="90"></p>
</td></tr><tr><td><br/><br/><br/><br/><br/><br/>

<div class="run" style="padding-top:20px;margin-right:100px;"></div>

</td></tr></table><marquee>All The Best !!</marquee><div class="run1" style="padding-top:20px;margin-right:100px;"></div>
</body>

</html>
