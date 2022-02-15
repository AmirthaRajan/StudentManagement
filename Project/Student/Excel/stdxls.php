<?php
	/*
	 Script Name: Read excel file in php with example
	 Script URI: http://allitstuff.com/?p=1303
	 Website URI: http://allitstuff.com/
	 */
	?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<div align='Center'>
<?php
		set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
	
	
	include 'PHPExcel/IOFactory.php';
	include '../config.php';
	
			$inputFileName = '//132.147.150.9/project/student/excel/stdxls.xlsx';  																		 	try {
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
	} catch(Exception $e) {
		die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
	}
	
	$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
	
	$info=$sheetData[1];
		$username= $info['A'];
		$rollno =  $info['B'];
		$regno =  $info['C'];
		$dob =  $info['D'];
		$dept =  $info['E'];
		$batch =  $info['F'];
		$section =  $info['G'];
		$school =  $info['H'];
		$percentage = $info['I'];
		$blood =  $info['J'];
		$religion =  $info['K'];
		$community =  $info['L'];
		$cast =  $info['M'];
		$fname =  $info['N'];
		$foccup =  $info['O'];
		$mname = $info['P'];
		$moccup =  $info['Q'];
		$address =  $info['R'];
		$phno1 =  $info['S'];
		$phno2 =  $info['T'];
		$phno3 =  $info['U'];
		$email =  $info['V'];
	$dummy=1;
	echo "<br>";
	$k=0;
	for($j=2;$j<sizeof($sheetData)+1;$j++)
	{
	$table = $sheetData[$j];
	$i = 0;
	foreach($table as $keys => $value )
	{

			$student[$k][$i] = $value;
			$i++;

	}
	$k++;
	}
	$u=0;
	$v=0;
	for($i=0;$i<sizeof($sheetData)-1;$i++)
	{
		$j=0;
		if(mysqli_query($con,$sql="UPDATE studinfo SET name = '".$student[$i][$j]."',regno = '".$student[$i][$j=$j+2]."',dob = '".$student[$i][++$j]."',department = '".$student[$i][++$j]."',batch = '".$student[$i][++$j]."',section = '".$student[$i][++$j]."',sem = '".$dummy."',school = '".$student[$i][++$j]."',percentage = '".$student[$i][++$j]."',blood = '".$student[$i][++$j]."',religion = '".$student[$i][++$j]."',community = '".$student[$i][++$j]."',gender = '".$student[$i][++$j]."',cast = '".$student[$i][++$j]."',fname = '".$student[$i][++$j]."',foccup = '".$student[$i][++$j]."',mname = '".$student[$i][++$j]."',moccup = '".$student[$i][++$j]."',address = '".$student[$i][++$j]."',phno1 = '".$student[$i][++$j]."',phno2 = '".$student[$i][++$j]."',phno3 = '".$student[$i][++$j]."',email = '".$student[$i][++$j]."' WHERE rollno='".$student[$i][1]."'") or die('Error: ' . mysqli_error($con))) 
		{
		$v++;
		}
		elseif(mysqli_query($con,$sql="INSERT INTO studinfo (id,name,rollno,regno,dob,department,batch,section,sem,school,percentage,blood,religion,community,gender,cast,fname,foccup,mname,moccup,address,phno1,phno2,phno3,email) VALUES ('','".$student[$i][$j++]."','".$student[$i][$j++]."','".$student[$i][$j++]."','".$student[$i][$j++]."','".$student[$i][$j++]."','".$student[$i][$j++]."','".$student[$i][$j++]."',".$dummy.",'".$student[$i][$j++]."','".$student[$i][$j++]."','".$student[$i][$j++]."','".$student[$i][$j++]."','".$student[$i][$j++]."','".$student[$i][$j++]."','".$student[$i][$j++]."','".$student[$i][$j++]."','".$student[$i][$j++]."','".$student[$i][$j++]."','".$student[$i][$j++]."','".$student[$i][$j++]."','".$student[$i][$j++]."','".$student[$i][$j++]."','".$student[$i][$j++]."','".$student[$i][$j++]."')")  or die('Error: ' . mysqli_error($con)))
		{
		$u++;
		}
		else
		{
		die('Error: ' . mysqli_error($con));	
		}
	}
	echo "<center><b>Successfully Inserted ".$u." Students<br/><br/>Successfully Updated ".$v." Students";
	
	
	?>
<body>
</html>