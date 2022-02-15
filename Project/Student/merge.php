<?php
error_reporting(E_ALL);
	ini_set('display_errors', true);
	$numm=0;
	$numu=0;
	include 'config.php';
$query1="select * from studinfo ";
$result1=mysqli_query($con,$query1) or die(mysqli_error($con));
$query2="select * from stud ";
$result2=mysqli_query($con,$query2) or die(mysqli_error($con));
$result3=mysqli_fetch_assoc($result2);
while($row=mysqli_fetch_array($result1))
{
if($result3['rollno']!=$row['rollno'])
{
$sql="INSERT INTO stud (name, rollno, regno, dob, department, batch, section,semester,school,percentage, blood, religion, community, cast, gender, status, photo, fname, foccup, fphoto, mname, moccup, mphoto, address, phno1, phno2, phno3, email)

        VALUES ('".$row['name']."','".$row['rollno']."','".$row['regno']."', '".$row['dob']."','".$row['department']."','".$row['batch']."','".$row['section']."','".$row['semester']."','".$row['school']."','".$row['percentage']."', '".$row['blood']."', '".$row['religion']."', '".$row['community']."', '".$row['cast']."', '".$row['gender']."', '".$row['status']."',' ".$row['photo']."', '".$row['fname']."','".$row['foccup']."', '".$row['fphoto']."', '".$row['mname']."', '".$row['moccup']."', '".$row['mphoto']."', '".$row['address']."', '".$row['phno1']."', '".$row['phno2']."', '".$row['phno3']."', '".$row['email']."')";
		
if (!mysqli_query($con,$sql))
		{
			echo"Error:". mysqli_error($con);
		}
		else
		{
		$numm++;
			
			}
			}
else
{
$sql="UPDATE 'stud' SET name = '".$row['name']."',regno = '".$row['regno']."',dob='".$row['dob']."',department = '".$row['department']."',batch = '".$row['batch']."',section = '".$row['section']."',gender = '".$row['gender']."',school = '".$row['school']."',percentage = '".$row['percentage']."',blood = '".$row['blood']."',religion = '".$row['religion']."',community = '".$row['community']."',cast = '".$row['cast']."',status = '".$row['status']."',photo = '".$row['photo']."',fphoto = '".$row['fphoto']."',mphoto = '".$row['mphoto']."',fname = '".$row['fname']."',foccup = '".$row['foccup']."',mname = '".$row['mname']."',moccup = '".$row['moccup']."',address = '".$row['address']."',phno1 = '".$row['phno1']."',phno2 = '".$row['phno2']."',phno3 = '".$row['phno3']."',email = '".$row['email']."' where rollno='$row['rollno']'"; 
if (!mysqli_query($con,$sql))
		{
			echo"Error:". mysqli_error($con);
		}
		else
		{
		$numu++;
			
			}
			}
			}
			echo "<center><b>You have successfully Merged ".$numm." records</b></center>";
			echo "<center><b>You have successfully Updated ".$numu." records</b></center>";
mysqli_close($con);
?>