<?php
	error_reporting(E_ALL);
	ini_set('display_errors', true);
	include 'config.php';
	$i = 0;
?>
<html>
<head>
<meta http-equiv="Content-Type"  charset="utf-8"/>
<title>
View Student
</title>
</head>
<body>
<style>
#Image
{
	max-width:100px;
	max-height:210px;
}
td
{
	text-align:center;
}
img
{
	max-width:100px;
	max-height:210px;
}
</style>
<div id="txtHint">
<form>
Department:
<select name="dept" id="dept" label="Department" >
<?php
	$res="SELECT DISTINCT department FROM studinfo ";
	$result=mysqli_query($con,$res) or die(mysqli_error($con));
	
	if (isset($_GET['dept']))
	{
		echo "<option value=".$_GET['dept']." selected>".$_GET['dept']."</option> ";
	}
	else
	{
		echo "<option value='' >-</option>";
	}
	while($row = mysqli_fetch_assoc($result))
	{
		echo "<option value=".$row['department']." >".$row['department']."</option> ";
	}
	?>
</select>
Batch:
<select name="batch" id="batch" label="Batch">
<?php
	
	if(!empty($_GET['dept']))
	{
		$res="SELECT DISTINCT batch FROM studinfo WHERE department = '".$_GET['dept']."' ";
		$result=mysqli_query($con,$res) or die(mysqli_error($con));
		
		if (isset($_GET['batch']))
		{
			echo "<option value=".$_GET['batch']." selected>".$_GET['batch']."</option> ";
		}
		else
		{
			echo " <option value='' >-</option>";
		}
		while($row = mysqli_fetch_assoc($result))
		{
			echo "<option value=".$row['batch']." >".$row['batch']."</option> ";
		}
	}
	?>
</select>
Section:
<select name="section" id="sect" label="Section">
<option value="">-</option>
<?php
	$res="SELECT DISTINCT section FROM studinfo WHERE department = '".$_GET['dept']."' and batch = '".$_GET['batch']."'";
	$result=mysqli_query($con,$res) or die(mysqli_error($con));
	while($row = mysqli_fetch_assoc($result))
	{
		echo "<option value=".$row['section']." >".$row['section']."</option> ";
	}
	?>
</select>
<div style="text-align:center">
Rollno:<input type="text" id="rollno" name="rollno">
Semester:<select name="sem" id="sem" label="Semester">
<option value="">-</option>
<?php
$s=1;
while($s<=8)
{
echo "<option value= $s > $s </option> ";
$s++;
}
?>
<input type="submit" value="View" onClick="show(rollno.value,sem.value)">
</div>
</form>
</div>
<script src=" jquery-2.0.2.min.js"></script>
<?php
	if(!empty($_GET))
	{
	echo "<br/>";
			if(isset($_GET['rollno']) && isset($_GET['sem']))
		{
				$sem=$_GET['sem'];
			@	$rollno = $_GET['rollno'];
			$query = "SELECT * FROM studinfo WHERE rollno = '".$rollno."'"; 
			$resource = mysqli_query($con,$query) or die(mysqli_error($con));
			$result = mysqli_fetch_assoc($resource);
				echo "<table border ='1'>";
				echo "<tr><th>Name</th><th>Rollno</th><th>Regno</th><th>DOB</th><th>Department</th><th>Batch</th><th>Section</th><th>School</th><th>Percentage</th><th>Blood</th><th>Religion</th><th>Community</th><th>Cast</th><th>Student's Photo</th><th>Father's Name</th><th>Father's Occupation</th><th>Father's Photo</th><th>Mother's Name</th><th>Mother's Occupation</th><th>Mother's Photo</th><th>Address</th><th>Phone Number 1</th><th>Phone Number2</th><th>Phone Number3</th><th>Email</th></tr>";
				echo "<tr><td>" .$result['name']."</td><td>".$result['rollno']."</td><td>".$result['regno']."</td><td>".$result['dob']."</td><td>".$result['department']."</td><td>".$result['batch']."</td><td>".$result['section']."</td><td>".$result['school']."</td><td>".$result['percentage']."</td><td>".$result['blood']."</td><td>".$result['religion']."</td><td>".$result['community']."</td><td>".$result['cast']."</td><td>".'<img id="image" src="data:image/jpeg;base64,' . base64_encode( $result['photo'] ) . '" />'."</td><td>".$result['fname']."</td><td>".$result['foccup']."</td><td>".'<img id="Image" src="data:image/jpeg;base64,' . base64_encode( $result['fphoto'] ) . '" />'."</td><td>".$result['mname']."</td><td>".$result['moccup']."</td><td>".'<img id="Image" src="data:image/jpeg;base64,' . base64_encode( $result['mphoto'] ) . '" />'."</td><td>".$result['address']."</td><td>".$result['phno1']."</td><td>".$result['phno2']."</td><td>".$result['phno3']."</td><td>".$result['email']."</td></tr>";  
				echo "</table>";
			for($i=$sem;$i>=$sem-1 && $i!=0;$i--)
			{
			$query1 = "SELECT InternalTest1,InternalTest2,ModelExam,gpa FROM semester".$i." WHERE rollno = '".$rollno."'";
			$resource1 = mysqli_query($con,$query1) or die(mysqli_error($con));
			$result1 = mysqli_fetch_assoc($resource1);
			$batch=mb_substr($rollno, 0, 4);
			$dept=mb_substr($rollno, 7, 2);
			$query2= "SELECT * from subject where semester = $i and batch= $batch and `department` = '$dept' ";
			$resource2 = mysqli_query($con,$query2) or die(mysqli_error($con));
			$result2 = mysqli_fetch_assoc($resource2);
			echo "</br><center><b>Semester".$i."</b></center>";
			echo "<table align='center'>";
			echo "<tr><td>";
			if($result1['InternalTest1'])
			{
				$mark1=unserialize($result1['InternalTest1']);
				$sub1=unserialize($result2['subname']);
				echo "<div style='text-align:center'>";
				echo "</br><b>InternalTest - I</b>";
				echo "</br>";
				echo "<table align='center' border='1'>";
				echo "<tr><th>$sub1[0]</th><th>$sub1[1]</th><th>".@ $sub1[2]."</th><th>".@ $sub1[3]."</th><th>".@ $sub1[4]."</th><th>".@ $sub1[5]."</th></tr>";
				echo "<tr><td>".@ $mark1[0]."</td><td>".@ $mark1[1]."</td><td>".@ $mark1[2]."</td><td>".@ $mark1[3]."</td><td>".@ $mark1[4]."</td><td>".@ $mark1[5]."</td></tr>";
				echo "</table>";
				echo "</div>";
			}
			echo "</td><td>";
			if($result1['InternalTest2'])
			{
				$mark2=unserialize($result1['InternalTest2']);
				$sub2=unserialize($result2['subname']);
				echo "<div style='text-align:center'>";
				echo "</br><b>InternalTest - II</b>";
				echo "</br>";
				echo "<table align='center' border='1'>";
				echo "<tr><th>$sub2[0]</th><th>$sub2[1]</th><th>".@ $sub2[2]."</th><th>".@ $sub2[3]."</th><th>".@ $sub2[4]."</th><th>".@ $sub2[5]."</th></tr>";
				echo "<tr><td>".@ $mark2[0]."</td><td>".@ $mark2[1]."</td><td>".@ $mark2[2]."</td><td>".@ $mark2[3]."</td><td>".@ $mark2[4]."</td><td>".@ $mark2[5]."</td></tr>";
				echo "</table>";
				echo "</div>";
			}
			echo "</td></tr>";
			echo "<tr><td>";
			if($result1['ModelExam'])
			{
				$mark3=unserialize($result1['ModelExam']);
				$sub3=unserialize($result2['subname']);
				echo "<div style='text-align:center'>";
				echo "</br><b>Model Exam</b>";
				echo "</br>";
				echo "<table align='center' border='1'>";
				echo "<tr><th>$sub3[0]</th><th>$sub3[1]</th><th>".@ $sub3[2]."</th><th>".@ $sub3[3]."</th><th>".@ $sub3[4]."</th><th>".@ $sub3[5]."</th></tr>";
				echo "<tr><td>".@ $mark3[0]."</td><td>".@ $mark3[1]."</td><td>".@ $mark3[2]."</td><td>".@ $mark3[3]."</td><td>".@ $mark3[4]."</td><td>".@ $mark3[5]."</td></tr>";
				echo "</table>";
				echo "</div>";
			}
			echo "</td><td>";
			if($result1['gpa'])
			{
				$mark4=unserialize($result1['gpa']);
				$sub4=unserialize($result2['subname']);
				echo "<div style='text-align:center'>";
				echo "</br><b>Semester GPA</b>";
				echo "</br>";
				echo "<table align='center' border='1'>";
				echo "<tr><th>$sub4[0]</th><th>$sub4[1]</th><th>".@ $sub4[2]."</th><th>".@ $sub4[3]."</th><th>".@ $sub4[4]."</th><th>".@ $sub4[5]."</th></tr>";
				echo "<tr><td>".@ $mark4[0]."</td><td>".@ $mark4[1]."</td><td>".@ $mark4[2]."</td><td>".@ $mark4[3]."</td><td>".@ $mark4[4]."</td><td>".@ $mark4[5]."</td></tr>";
				echo "</table>";
				echo "</div>";
			}
			echo "</td></tr>";
			echo "</table>";
			$found=null;
			$atn=null;
			$abs=null;
			$abs['a']=0;
			$query2="SELECT sem".$i." FROM attendance WHERE rollno= '".$rollno."'" ;
			$resource2=mysqli_query($con,$query2) or die(mysqli_error($con));
			$result2=mysqli_fetch_assoc($resource2);
			$atn=$result2['sem'.$i];
			echo $found;
@			$abs=array_count_values(unserialize($atn));
			if(@ $abs['a']==null)
			{
			$abs['a']=0;
			$found=sizeof($abs);
			}
			else
			{
				$found=sizeof($abs)-1;
			}
			echo "</br><center><b>Attendance</b></center>";
			echo "<table align='center' border='2'>";
			echo "<tr><th>Days Present</th><th>Days Absent</th></tr>";
			echo "<div align='center'>";
			echo "<tr><td>".$found."</td><td>".$abs['a']."</td></tr>";
			echo "</table></div>";
			}
			
		}	
	if(isset($_GET['dept']) && isset($_GET['batch']) && isset($_GET['sec']))
	{
		@		$department = $_GET['dept'];
		@		$batch = $_GET['batch'];
		@		$section = $_GET['sec'];
		$query = "SELECT * FROM studinfo WHERE department = '".$department."' and batch = '".$batch."' and section = '".$section."' "; 
		$resource = mysqli_query($con,$query) or die(mysqli_error($con));
		echo "<table border='1'>";
		echo "<tr><th>Name</th><th>Rollno</th><th>Regno</th><th>DOB</th><th>Department</th><th>Batch</th><th>Section</th><th>School</th><th>Percentage</th><th>Blood</th><th>Religion</th><th>Community</th><th>Cast</th><th>Student's Photo</th><th>Father's Name</th><th>Father's Occupation</th><th>Father's Photo</th><th>Mother's Name</th><th>Mother's Occupation</th><th>Mother's Photo</th><th>Address</th><th>Phone Number 1</th><th>Phone Number2</th><th>Phone Number3</th><th>Email</th></tr>";
		while($result = mysqli_fetch_assoc($resource))
		{
			echo "<tr><td>" .$result['name']."</td><td>".$result['rollno']."</td><td>".$result['regno']."</td><td>".$result['dob']."</td><td>".$result['department']."</td><td>".$result['batch']."</td><td>".$result['section']."</td><td>".$result['school']."</td><td>".$result['percentage']."</td><td>".$result['blood']."</td><td>".$result['religion']."</td><td>".$result['community']."</td><td>".$result['cast']."</td><td>".'<img id="image" src="data:image/jpeg;base64,' . base64_encode( $result['photo'] ) . '" />'."</td><td>".$result['fname']."</td><td>".$result['foccup']."</td><td>".'<img id="Image" src="data:image/jpeg;base64,' . base64_encode( $result['fphoto'] ) . '" />'."</td><td>".$result['mname']."</td><td>".$result['moccup']."</td><td>".'<img id="Image" src="data:image/jpeg;base64,' . base64_encode( $result['mphoto'] ) . '" />'."</td><td>".$result['address']."</td><td>".$result['phno1']."</td><td>".$result['phno2']."</td><td>".$result['phno3']."</td><td>".$result['email']."</td></tr>";  	
		}
		echo "</table>";
	}
	}	
?>
<script>
function show(rollno,sem)
{
	if (rollno=="")
	{
		document.getElementById("txtHint").innerHTML="";
		return;
	} 
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("GET","vewstu.php?rollno="+rollno+"&sem="+sem,false);
	xmlhttp.send();
}
</script>

<script>
$(document).ready(function()
				  {
				  
				  $('#dept').on( 'change', function() 
								{         
								$("#txtHint").hide();
								$.ajax({
									   type: "GET",
									   url:"vewstu.php",
									   data:"dept="+this.value,
									   success: function(result) 
									   {
									   
									   $("#txtHint").html(result);
									   $("#txtHint").show();
									   
									   }
									   })
								});
				  $('#batch').on( 'change', function() 
								 {         
								 $("#txtHint").hide();
								 $.ajax({
										type: "GET",
										url:"vewstu.php",
										data:"dept="+document.getElementById("dept").value+"&batch="+this.value,
										success: function(result) 
										{
										
										$("#txtHint").html(result);
										$("#txtHint").show();
										
										}
										})
								 });
				  $('#sect').on( 'change', function() 
								 {         
								 $("#txtHint").hide();
								 $.ajax({
										type: "GET",
										url:"vewstu.php",
										data:"dept="+document.getElementById("dept").value+"&batch="+document.getElementById("batch").value+"&sec="+this.value,
										success: function(result) 
										{
										
										$("#txtHint").html(result);
										$("#txtHint").show();
										
										}
										})
								 });
				  });
</script>
</body>
</html>