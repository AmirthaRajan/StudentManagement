<html>
<head>
<meta http-equiv="Content-Type"  charset="utf-8"/>

<title>Edit Student</title>
</head>
<?php 
	include 'config.php';
	if(isset($_POST['rollno']))
	{
		$response=mysqli_query($con,"select * from studinfo where rollno='".$_POST['rollno']."'") or die(mysqli_error($con));
		$result=mysqli_fetch_array($response);
	}
	if(isset($_POST['regno']))
	{
	    $photo = @mysqli_real_escape_string($con,fread (fopen ($_FILES['photo']['tmp_name'], "r"), filesize($_FILES['photo']['tmp_name'])));
		$fphoto = @mysqli_real_escape_string($con,fread (fopen ($_FILES['fphoto']['tmp_name'], "r"), filesize($_FILES['fphoto']['tmp_name'])));
		$mphoto = @mysqli_real_escape_string($con,fread (fopen ($_FILES['mphoto']['tmp_name'], "r"), filesize($_FILES['mphoto']['tmp_name'])));
		$rollno=mysqli_real_escape_string($con,$_POST['rollno']);
		$username=mysqli_real_escape_string($con,$_POST['username']);
		$regno = mysqli_real_escape_string($con,$_POST['regno']);
		$school = mysqli_real_escape_string($con,$_POST['school']);
		$percentage = mysqli_real_escape_string($con,$_POST['percentage']);
		$blood = mysqli_real_escape_string($con,$_POST['blood']);
		$religion = mysqli_real_escape_string($con,$_POST['religion']);
		$community = mysqli_real_escape_string($con,$_POST['community']);
		$gender = mysqli_real_escape_string($con,$_POST['gen']);
		$cast = mysqli_real_escape_string($con,$_POST['cast']);
		$fname = mysqli_real_escape_string($con,$_POST['fname']);
		$foccup = mysqli_real_escape_string($con,$_POST['foccup']);
		$mname = mysqli_real_escape_string($con,$_POST['mname']);
		$moccup = mysqli_real_escape_string($con,$_POST['moccup']);
		$address = mysqli_real_escape_string($con,$_POST['address']);
		$phno1 = mysqli_real_escape_string($con,$_POST['phno1']);
		$phno2 = mysqli_real_escape_string($con,$_POST['phno2']);
		$phno3 = mysqli_real_escape_string($con,$_POST['phno3']);
		$email = mysqli_real_escape_string($con,$_POST['email']);
		if($photo && $fphoto && $mphoto)
		$sql="UPDATE studinfo SET name = '".$username."',regno = '".$regno."',department = '".$_POST['department']."',batch = '".$_POST['batch']."',section = '".$_POST['section']."',gender = '".$gender."',school = '".$school."',percentage = '".$percentage."',blood = '".$blood."',religion = '".$religion."',community = '".$community."',cast = '".$cast."',status = '".$_POST['status']."',photo = '".$photo."',fphoto = '".$fphoto."',mphoto = '".$mphoto."',fname = '".$fname."',foccup = '".$foccup."',mname = '".$mname."',moccup = '".$moccup."',address = '".$address."',phno1 = '".$phno1."',phno2 = '".$phno2."',phno3 = '".$phno3."',email = '".$email."' WHERE rollno='".$rollno."'"; 
		if($photo)
		$sql="UPDATE studinfo SET name = '".$username."',regno = '".$regno."',department = '".$_POST['department']."',batch = '".$_POST['batch']."',section = '".$_POST['section']."',gender = '".$gender."',school = '".$school."',percentage = '".$percentage."',blood = '".$blood."',religion = '".$religion."',community = '".$community."',cast = '".$cast."',status = '".$_POST['status']."',photo = '".$photo."',fname = '".$fname."',foccup = '".$foccup."',mname = '".$mname."',moccup = '".$moccup."',address = '".$address."',phno1 = '".$phno1."',phno2 = '".$phno2."',phno3 = '".$phno3."',email = '".$email."' WHERE rollno='".$rollno."'"; 
		if($fphoto && $mphoto)
		$sql="UPDATE studinfo SET name = '".$username."',regno = '".$regno."',department = '".$_POST['department']."',batch = '".$_POST['batch']."',section = '".$_POST['section']."',gender = '".$gender."',school = '".$school."',percentage = '".$percentage."',blood = '".$blood."',religion = '".$religion."',community = '".$community."',cast = '".$cast."',status = '".$_POST['status']."',fphoto = '".$fphoto."',mphoto = '".$mphoto."',fname = '".$fname."',foccup = '".$foccup."',mname = '".$mname."',moccup = '".$moccup."',address = '".$address."',phno1 = '".$phno1."',phno2 = '".$phno2."',phno3 = '".$phno3."',email = '".$email."' WHERE rollno='".$rollno."'"; 
		if(!$photo && !$fphoto && !$mphoto)
		$sql="UPDATE studinfo SET name = '".$username."',regno = '".$regno."',department = '".$_POST['department']."',batch = '".$_POST['batch']."',section = '".$_POST['section']."',gender = '".$gender."',school = '".$school."',percentage = '".$percentage."',blood = '".$blood."',religion = '".$religion."',community = '".$community."',cast = '".$cast."',status = '".$_POST['status']."',fname = '".$fname."',foccup = '".$foccup."',mname = '".$mname."',moccup = '".$moccup."',address = '".$address."',phno1 = '".$phno1."',phno2 = '".$phno2."',phno3 = '".$phno3."',email = '".$email."' WHERE rollno='".$rollno."'"; 
		if (!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error($con));
		}
		else
		{
			echo "<center><b>You have successfully Updated</b></center>";
		for($i=1;$i<9;$i++)
		{
			$sql1="UPDATE semester".$i." SET regno = '".$regno."',name = '".$username."',batch = '".$_POST['batch']."',department = '".$_POST['department']."',section = '".$_POST['section']."' WHERE rollno = '".$rollno."' ";
			mysqli_query($con,$sql1);
		}
			$sql2="UPDATE attendance SET regno = '".$regno."',name = '".$username."',batch = '".$_POST['batch']."',department = '".$_POST['department']."',section = '".$_POST['section']."' WHERE rollno = '".$rollno."' ";
			mysqli_query($con,$sql2);
			$sql2="UPDATE period SET regno = '".$regno."',name = '".$username."',batch = '".$_POST['batch']."',department = '".$_POST['department']."',section = '".$_POST['section']."' WHERE rollno = '".$rollno."' ";
			mysqli_query($con,$sql2);
		}
		mysqli_close($con);
	}
?>
<body>
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
input[type=button]:hover 
{ 
transition: .65s ease-in-out;
	-moz-transition: .65s ease-in-out;
color:#FF0000;
}

input[type=button] 
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
img
{
	height:165px;
	width:120px;
}
td
{
	 text-align:center;
}
</style>

<b><p id="head" style="text-align:center;font-size:32px;">Edit Details</p></b>

<div id="roll" style="font-size:26px;" align="center">
<form method="POST" id="form1">
Rollno:<input type="text" name="rollno" id="rollno" /><input type="button" name="butn" id="edit" value="Edit">
</form>
</div>
<div id="result">
<form method="POST" enctype="multipart/form-data" id="form2">
<table border="0" align="center">
<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td style="font-size:28px;">Name  </td><td>:</td><td><input type="text" name="username" value="<?php echo @$result['name']?>"></td></tr>
<input type="hidden" name="rollno" value="<?php echo @ $result['rollno']?>">
<tr><td style="font-size:28px;">Regno  </td><td>:</td><td><input type="text" name="regno" value="<?php echo @$result['regno']?>"></td></tr>

<tr><td style="font-size:28px;">Department  </td><td>:</td><td><select name="department" value="dept">
<option value="<?php echo $result['department']?>"><?php echo @$result['department'] ?></option>
<option value="IT">IT</option>
<option value="CSE">CSE</option>
<option value="ECE">ECE</option>
<option value="EEE">EEE</option>
<option value="MEC">MEC</option>
</select></td></tr>

<tr><td style="font-size:28px;">Year/Batch  </td><td>:</td><td><select name="batch" >
<option value="<?php echo $result['batch']?>"><?php echo @$result['batch'] ?> </option>
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
<option value="<?php echo $result['section']?>"><?php echo @$result['section']?></option>
<option value="">-</option>
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="D">D</option>
</select></td></tr>

<tr><td style="font-size:28px;">School/College  </td><td>:</td><td><input type="text" name="school" value="<?php echo @$result['school']?>"></td></tr>
<tr><td style="font-size:28px;">Percentage  </td><td>:</td><td><input type="text" name="percentage" value="<?php echo @$result['percentage']?>"></td></tr>
<tr><td style="font-size:28px;">Blood Group  </td><td>:</td><td><input type="text" name="blood" value="<?php echo @$result['blood']?>"></td></tr>
<tr><td style="font-size:28px;">Religion  </td><td>:</td><td><input type="text" name="religion" value="<?php echo @$result['religion']?>"></td></tr>
<tr><td style="font-size:28px;">Community </td><td>:</td><td><input type="text" name="community" value="<?php echo @$result['community']?>"></td></tr>
<tr><td style="font-size:28px;">Cast  </td><td>:</td><td><input type="text" name="cast" value="<?php echo @$result['cast']?>"></td></tr>
<?php
	if (@$result['gender'] == "male")
	{
		echo "<tr><td style='font-size:28px;'>Gender</td><td>:</td><td><input type='radio' name='gen' value='male' checked='checked' >Male<input type='radio' name='gen' value='female'>Female</td></tr>";
    }
	else
	{
		echo "<tr><td style='font-size:28px;'>Gender</td><td>:</td><td><input type='radio' name='gen' value='male' >Male<input type='radio' name='gen' value='female' checked='checked' >Female</td></tr>";
	}
?>
<tr><td style="font-size:28px;">Status  </td><td>:</td>
<td><select name="status" >
<option  value="<?php echo $result['status']?>"><?php echo @$result['status']?></option>
<option value="single">single</option>
<option value="married">married</option>
</select></td></tr>

<tr><td><hr></td><td><hr></td><td><hr></td></tr>
<tr style="font-size:30px;text-align:center;" ><td><b>Contact</b></td><td></td><td><b>Details</b></td></tr>
<tr><td><hr></td><td><hr></td><td><hr></td></tr>

<tr><td style="font-size:28px;">Student Photo  </td><td>:</td><td><input type="file" name="photo" ></td><td> <?php echo '<img id="Image" src="data:image/jpeg;base64,' . base64_encode(@ $result['photo'] ) . '" />' ?></td></tr>
<tr><td style="font-size:28px;">Father's Name  </td><td>:</td><td><input type="text" name="fname"  value="<?php echo @$result['fname']?>"></td></tr>
<tr><td style="font-size:28px;">Father's Occupation  </td><td>:</td><td><input type="text" name="foccup"  value="<?php echo @$result['foccup']?>"></td></tr>
<tr><td style="font-size:28px;">Father's Photo  </td><td>:</td><td><input type="file" name="fphoto" ></td><td><?php echo '<img id="Image" src="data:image/jpeg;base64,' . base64_encode(@ $result['fphoto'] ) . '" />' ?></td></tr>
<tr><td style="font-size:28px;">Mother's Name  </td><td>:</td><td><input type="text" name="mname" value="<?php echo @$result['mname']?>"></td></tr>
<tr><td style="font-size:28px;">Mother's Occupation  </td><td>:</td><td><input type="text" name="moccup" value="<?php echo @$result['moccup']?>"></td></tr>
<tr><td style="font-size:28px;">Mother's Photo  </td><td>:</td><td><input type="file" name="mphoto" ></td><td><?php echo '<img id="Image" src="data:image/jpeg;base64,' . base64_encode(@ $result['mphoto'] ) . '" />' ?></td></tr>

<tr><td style="font-size:28px;">Address  </td><td>:</td><td><input type="text" name="address" value="<?php echo @$result['address']?>"></td></tr>
<tr><td style="font-size:28px;">Phone No1  </td><td>:</td><td><input type="text" name="phno1" value="<?php echo @$result['phno1']?>"></td></tr>
<tr><td style="font-size:28px;">Phone No2  </td><td>:</td><td><input type="text" name="phno2" value="<?php echo @$result['phno2']?>"></td></tr>
<tr><td style="font-size:28px;">Phone No3(Optional)  </td><td>:</td><td><input type="text" name="phno3"  value="<?php echo @$result['phno3']?>"></td></tr>
<tr><td style="font-size:28px;">Email ID </td><td>:</td><td><input type="text" name="email"  value="<?php echo @$result['email']?>"></td></tr>

<tr><td><hr></td><td><hr></td><td><hr></td></tr>
<tr><td style="font-size:30px;">Submit to Edit  </td><td>:</td><td><input id="submit" type="submit" value="Submit" /></td></tr>
<tr><td><hr></td><td><hr></td><td><hr></td></tr>	
</table>
</form>
</div>
<span text-align='center' id="spn1"></span>
<script src="jquery-2.0.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
				  {

					$( "#edit" ).on( "click", function( )
								   {
								   var str = $( "#form1" ).serialize();
								   $.ajax({
										  type: "POST",
										  url: "edtstu.php",
										  data:str,
										  success: function(data) 
										  {
										  $("#roll").hide();
										  $("#head").hide();
										  $("#result").html(data);
										  }
										  });
								   });
								   
					$("#form2").on("submit", function( ) 
					{
					event.preventDefault();
					var valu = $("#form2").serialize();
					console.log(valu);
					event.preventDefault();
					$.ajax({
						async:false,
						type: "POST",
						url: "edtstu.php",
						data: valu,
						success: function(rest)
						{
							$("#result").html(rest);
						},
						error:function(){
							alert("failure");
							$("#result").html('There is error while submit');
						}
						});
					 });
				  });
												 
</script>
</body>
</html>
