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
/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';
include '../config.php';

// $inputFileName=fread (fopen ($_FILES['inputFileName']['tmp_name'], "r"), filesize($_FILES['inputFileName']['tmp_name']));
// $dir = dirname(__FILE__);
// print_r($inputFileName);
// $inputFileName = $_file['temp_filename']
$inputFileName = '//132.147.150.9/project/student/excel/mrkxls.xlsx';  // File to read
//echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

$info=$sheetData[1];
//echo unserialize($sheetData));
$batch = $info['A'];
$section = $info['B'];
$sem = $info['C'];
$test = $info['D'];
$number= $info['E'];
	echo "<table border=1>";
	echo "<tr><th>Batch</th><th>Section</th><th>Semester</th><th>Test</th></tr>";
	echo "<tr><td>".$batch."</td><td>".$section."</td><td>".$sem."</td><td>".$test."</td></tr>";
	echo "</table>";
	echo "<br>";

$table = $sheetData[2];
$i = 0;
foreach($table as $keys => $value )
{
	if($keys == 'A')
	$rollno = $value;
	else
	{
	$subject[$i] = $value;
			//	echo $subject[$i]." ".$i."</br>";
	$i++;
	}
}
$qry=mysqli_query($con,"SELECT * FROM subject WHERE SEMESTER = $sem and batch = $batch");
	echo $sem."<br/>";

$result = mysqli_fetch_assoc($qry);
$subcode = unserialize($result['subcode']);
		//print_r($subject);

for($q=0;$q<sizeof($subcode);$q++)
	{
	$key[$q]=array_search(@ $subject[$q],$subcode);
			//	print_r($key);
			//	echo $number;
			//echo @ $subject[$q];
	}
		//$key[$q]=array_keys($subcode,$subject[$q]);
		//echo "<br>";
$m=0;
$z=0;
	for($j=2;$j<=sizeof($sheetData);$j++)
	{
			//	echo sizeof($sheetData);
		$row=$sheetData[$j];
	//	print_r($row);
		$n=0;
		$p=0;
		foreach($row as $keys => $values)
		{
			if($p<$number)
			{
			if($keys == 'A')
			{
			$rollnum[$m][$n]=$values;
			if($values != 'Rollno' || $values != 'Regno')
			{
			$roll[$z]=$values;
			$z++;
			}
			}
			else
			{
			$mark[$m][$key[$p]]=$values;
				echo $value;
			$p++;
			}
			}
			$n++;
		}
			//		print_r($mark[$m]);
			//	echo "<br/>";
	$m++;
	}
//	echo $roll[0];
	echo "<table border='1'>";
	for($i=0;$i<$m;$i++)
	{
		echo "<tr>";
		if($i==0)
		echo "<th>".$rollno."</th>";
		for($j=0;$j<$number;$j++)
		{				
			if($i==0 && $j < sizeof($sheetData[2])-1 )
			echo "<th>".$subcode[$key[$j]]."</th>";
			elseif($i>0 && $j==0)
			{
			echo "<td>".$rollnum[$i][$j]."</td>";
			}
		}
		for($j=0;$j<$number;$j++)
		{
			if(@ $mark[$i][$key[$j]] != null)
				echo "<td>".@ $mark[$i][$key[$j]]."</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
	$d=0;
	for($i=1;$i<sizeof($sheetData)-1;$i++)
	{
		$mrk[$d]=$mark[$i];
		$d++;
	}
	for($i=0;$i<sizeof($sheetData)-3;$i++)
	{
			$subj[$i]=serialize($mrk[$i]);
			$mk[$i]=serialize($mrk[$i]);
			//			echo $mk[$i]."<br/>";
	}
	for($j=0;$j<sizeof($sheetData)-2;$j++)
	{
		if($roll[0]=='Rollno')
@	$sql="Update semester$sem SET `$test` = '$mk[$j]' where `rollno` = '$roll[$j]'  and `batch` = '$batch' ";
			//				echo "<br>".$sql;
		if($roll[0] == 'Regno')
@	$sql="Update semester$sem SET `$test` = '$mk[$j]' where `regno` = '$roll[$j]'  and `batch` = '$batch' ";
	mysqli_query($con,$sql) or die(mysqli_error($con));
	}
	 

?>
<body>
</html>