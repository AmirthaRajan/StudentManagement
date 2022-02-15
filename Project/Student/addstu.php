<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', true);
	$nameErr=$rollErr=$regErr=$dobErr=$castErr=$comErr=$perErr=$phnoErr=" ";
	include 'config.php';
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$count=0;
if(!empty($_GET))
if($_GET['get'] == 1)
{
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		
		if (empty($_GET["username"]))
		{$nameErr = "Name is required";$count++;}
		if (empty($_GET["rollno"]))
		{$rollErr = "Email is required";$count++;}
		if (empty($_GET["regno"]))
		{$regErr = "Regno is required";$count++;}
		if (empty($_GET["dob"]))
		{$dobErr = "DOB is required";$count++;}
		if (empty($_GET["cast"]))
		{$castErr = "Cast is required";$count++;}
		if (empty($_GET["community"]))
		{$comErr = "Community is required";$count++;}
		if (empty($_GET["percentage"]))
		{$perErr = "Percentage is required";$count++;}
		if (empty($_GET["phno1"]))
		{$phnoErr = "Phone Number is required";$count++;}
	}
	if($count > 0)
	{
		echo "<center color='red'>Please fill the required fields</center>";
	}
	else
	{
	
		$photo = @mysqli_real_escape_string($con,fread (fopen ($_FILES['photo']['tmp_name'], "r"), filesize($_FILES['photo']['tmp_name'])));
		$fphoto = @mysqli_real_escape_string($con,fread (fopen ($_FILES['fphoto']['tmp_name'], "r"), filesize($_FILES['fphoto']['tmp_name'])));
		$mphoto = @mysqli_real_escape_string($con,fread (fopen ($_FILES['fphoto']['tmp_name'], "r"), filesize($_FILES['mphoto']['tmp_name'])));
		$username=mysqli_real_escape_string($con,$_GET['username']);
		$rollno = mysqli_real_escape_string($con,$_GET['rollno']);
		$regno = mysqli_real_escape_string($con,$_GET['regno']);
		$dob = mysqli_real_escape_string($con,$_GET['dob']);
		$school = mysqli_real_escape_string($con,$_GET['school']);
		$percentage = mysqli_real_escape_string($con,$_GET['percentage']);
		$blood = mysqli_real_escape_string($con,$_GET['blood']);
		$religion = mysqli_real_escape_string($con,$_GET['religion']);
		$community = mysqli_real_escape_string($con,$_GET['community']);
		$cast = mysqli_real_escape_string($con,$_GET['cast']);
		$fname = mysqli_real_escape_string($con,$_GET['fname']);
		$foccup = mysqli_real_escape_string($con,$_GET['foccup']);
		$mname = mysqli_real_escape_string($con,$_GET['mname']);
		$moccup = mysqli_real_escape_string($con,$_GET['moccup']);
		$address = mysqli_real_escape_string($con,$_GET['address']);
		$phno1 = mysqli_real_escape_string($con,$_GET['phno1']);
		$phno2 = mysqli_real_escape_string($con,$_GET['phno2']);
		$phno3 = mysqli_real_escape_string($con,$_GET['phno3']);
		$email = mysqli_real_escape_string($con,$_GET['email']);
		$sem = range(1,8);
		$semester=serialize($sem);
		$dummy = 1;
		$sql="INSERT INTO studinfo (id,name,rollno,regno,dob,department,batch,section,semester,sem,school,percentage,blood,religion,community,cast,status,photo,fname,foccup,fphoto,mname,moccup,mphoto,address,phno1,phno2,phno3,email) VALUES ('','".$username."','".$rollno."','".$regno."','".$dob."','".$_GET['department']."','".$_GET['batch']."','".$_GET['section']."','".$semester."',".$dummy.",'".$school."','".$percentage."','".$blood."','".$religion."','".$community."','".$cast."','".$_GET['status']."','".$photo."','".$fname."','".$foccup."','".$fphoto."','".$mname."','".$moccup."','".$mphoto."','".$address."','".$phno1."','".$phno2."','".$phno3."','".$email."')";
		if (!mysqli_query($con,$sql))
	    {
			die('Error: ' . mysqli_error($con));
	    }
		 
		else
		{
			echo "<center><b> Successfully Registered </b></center>";
		}
		 
		 for($i=1;$i<9;$i++)
		 {
		 $sql1="INSERT INTO semester".$i." (regno,rollno,name,batch,department,section) VALUES ( '".$regno."' ,'".$rollno."','".$username."', '".$_GET['batch']."' , '".$_GET['department']."' , '".$_GET['section']."' ) ";
	     mysqli_query($con,$sql1);
		 }
		 $sql2="INSERT INTO attendance (regno,rollno,name,batch,department,section) VALUES ( '".$regno."' ,'".$rollno."','".$username."', '".$_GET['batch']."' , '".$_GET['department']."' , '".$_GET['section']."' ) ";
	     mysqli_query($con,$sql2);
		 $sql3="INSERT INTO period (regno,rollno,name,batch,department,section) VALUES ( '".$regno."' ,'".$rollno."','".$username."', '".$_GET['batch']."' , '".$_GET['department']."' , '".$_GET['section']."' ) ";
	     mysqli_query($con,$sql3);
	 
	}
}
	mysqli_close($con);
	
?>
<html>
<head>
<meta http-equiv="Content-Type"  charset="utf-8"/>
<title>Register Student</title>
</head>
<body >
<style>
input[type=submit]:hover 
{ 
	transition: .65s ease-in-out;
	-moz-transition: .65s ease-in-out;
	color:#FF0000;
}

input[type=submit] 
{	
	transition: .65s ease-in-out;
	-moz-transition: .65s ease-in-out;
	color:#000000;
	font-size: 26px;
}
.error
{
color:#ff0000;
}
hr 
{ 
display: block; height: 1px;
border: 0; border-top: 1px solid black;
padding: 0; 
}
</style>
<div id="txt">
<b><p style="text-align:center;font-size:30px;">Registration Form</p></b>
<form id="form" enctype="multipart/form-data">
<table id="tbl" border="0" align="center">
<tr><td style="font-size:26px;"><p><span class="error">* required field.</span></p></td></tr>
<tr><td style="font-size:28px;">Name  </td><td>:</td><td><input type="text" name="username" ><span class="error">*<?php echo $nameErr ?></span></td></tr>
<tr><td style="font-size:28px;">Rollno  </td><td>:</td><td><input type="text" name="rollno" ><span class="error">*<?php echo $rollErr ?></span></td></tr>
<tr><td style="font-size:28px;">Regno  </td><td>:</td><td><input type="text" name="regno"><span class="error">*<?php echo $regErr ?></span></td></tr>
<tr><td style="font-size:28px;">DOB  </td><td>:</td><td><input type="date" name="dob"><span class="error">*<?php echo $dobErr ?></span></td></tr>

<tr><td style="font-size:28px;">Department  </td><td>:</td><td><select name="department" value="dept">
<option value="IT">IT</option>
<option value="CSE">CSE</option>
<option value="ECE">ECE</option>
<option value="EEE">EEE</option>
<option value="MEC">MEC</option>
</select></td></tr>

<tr><td style="font-size:28px;">Year/Batch  </td><td>:</td><td><select name="batch" >
<option value="2010">2008</option>
<option value="2010">2009</option>
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
</select></td></tr>

<tr><td style="font-size:28px;">Section  </td><td>:</td><td><select name="section" >
<option value="">-</option>
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="D">D</option>
<option value="E">E</option>
</select></td></tr>

<tr><td style="font-size:28px;">School/College  </td><td>:</td><td><input type="text" name="school"></td></tr>
<tr><td style="font-size:28px;">Percentage  </td><td>:</td><td><input type="text" name="percentage"><span class="error">*<?php echo $perErr ?></span></td></tr>
<tr><td style="font-size:28px;">Blood Group  </td><td>:</td><td><input type="text" name="blood"></td></tr>
<tr><td style="font-size:28px;">Religion  </td><td>:</td><td><input type="text" name="religion"></td></tr>
<tr><td style="font-size:28px;">Community </td><td>:</td><td><input type="text" name="community"><span class="error">*<?php echo $comErr ?></span></td></tr>
<tr><td style="font-size:28px;">Cast </td><td>:</td><td><input type="text" name="cast"><span class="error">*<?php echo $castErr ?></span></td></tr>
<tr><td style="font-size:28px;">Gender</td><td>:</td><td><input type="radio" name="gen" value="male" >Male<input type="radio" name="gen" value="female" >Female</td></tr>

<tr><td style="font-size:28px;">Status  </td><td>:</td><td><select name="status" >
<option value="single">single</option>
<option value="married">married</option>
</select></td></tr>

<tr><td><hr></td><td><hr></td><td><hr></td></tr>
<tr style="font-size:30px;text-align:center;" ><td><b>Contact</b></td><td></td><td><b>Details</b></td></tr>
<tr><td><hr></td><td><hr></td><td><hr></td></tr>

<tr><td style="font-size:28px;">Student Photo  </td><td>:</td><td><input type="file" name="photo"></td></tr>
<tr><td style="font-size:28px;">Father's Name  </td><td>:</td><td><input type="text" name="fname"></td></tr>
<tr><td style="font-size:28px;">Father's Occupation  </td><td>:</td><td><input type="text" name="foccup"></td></tr>
<tr><td style="font-size:28px;">Father's Photo  </td><td>:</td><td><input type="file" name="fphoto"></td></tr>
<tr><td style="font-size:28px;">Mother's Name  </td><td>:</td><td><input type="text" name="mname"></td></tr>
<tr><td style="font-size:28px;">Mother's Occupation  </td><td>:</td><td><input type="text" name="moccup"></td></tr>
<tr><td style="font-size:28px;">Mother's Photo  </td><td>:</td><td><input type="file" name="mphoto"></td></tr>

<tr><td style="font-size:28px;">Address  </td><td>:</td><td><input type="text" name="address" ></td></tr>
<tr><td style="font-size:28px;">Phone No1  </td><td>:</td><td><input type="text" name="phno1" ><span class="error">*<?php echo $phnoErr ?></span></td></tr>
<tr><td style="font-size:28px;">Phone No2  </td><td>:</td><td><input type="text" name="phno2" ></td></tr>
<tr><td style="font-size:28px;">Phone No3(Optional)  </td><td>:</td><td><input type="text" name="phno3" ></td></tr>
<tr><td style="font-size:28px;">Email ID </td><td>:</td><td><input type="text" name="email" ></td></tr>


</table>
</form>
<span id="spn"></span>
	<table id="tbl1" border="0" align="center">
	<tr><td><hr></td><td><hr></td><td><hr></td></tr>
	<tr><td style="font-size:30px;">Submit to Register  </td><td>:</td><td><input type="submit" name="submit" id="submit" value="Register"></td></tr>
	<tr><td><hr></td><td><hr></td><td><hr></td></tr>
	</table>
</div>
<script src="jquery-2.0.2.min.js"></script>
<script>
$(document).ready( function()
				  {
				  
				  $( "#submit" ).on( "click", function( event )
								   {
								   var str = $( "form" ).serialize();
								   $.ajax({
										  type: "GET",
										  url: "addstu.php",
										  data:str+"&get="+1,
										  success: function(data) {
										  $("#txt").hide();
										  $("#spn").html(data);
										  console.log( $( this ).serialize() );
										  }
										  });
								   });
				  });
									
									
</script>									
</body>
</html>