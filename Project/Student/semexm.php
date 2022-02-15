<html>
<head>
<meta http-equiv="Content-Type"  charset="utf-8"/>
<title>
Edit Subject
</title>
</head>
<body>
<style>
td
{
	text-align:center;
}
input[type=submit]
{
}
</style>
<script>
i=0; startrow=0;prev=0;
</script>
<div id="txtHint">
<form name="form" id="form">
<?php
	error_reporting(E_ALL);
	ini_set('display_errors', true);
include 'config.php';
	?>
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
Semester:
<select name="sem" id="sem" label="Semester">
<?php
	if(isset($_GET['batch']))
	{
		$res="SELECT DISTINCT semester FROM studinfo ";
		$result=mysqli_query($con,$res) or die(mysqli_error($con));
		if (isset($_GET['sem']))
		{
			echo "<option value=".$_GET['sem']." selected>".$_GET['sem']."</option> ";
		}
		else
		{
			echo " <option value='' >-</option>";
		}
		while($row= mysqli_fetch_array($result))
		{
			$rows=unserialize($row['semester']);
			foreach($rows as $key => $value)
			{
				echo "<option value=".$value." >".$value."</option> ";
			}
		}
	}
	?>
</select>
<script src=" jquery-2.0.2.min.js"></script>
<?php
	echo "</br>";
	if(!empty($_GET))
	{
		
		if(isset($_GET['submit']))
		{			
			
			@		$department = $_GET['dept'];
			@		$batch = $_GET['batch'];
			@		$semester = $_GET['sem'];
			
/*			if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) 
			{
				echo "<script> startrow=0;</script>";
				$startrow = 0;
			} 
			else 
			{
				$startrow = (int)$_GET['startrow'];
			}
			*/
			$qrycnt = "SELECT COUNT(*) FROM semester".$semester." WHERE batch = '$batch' and department = '$department'";
			$rescnt = mysqli_query($con,$qrycnt) or die(mysqli_error($con));
			$count=mysqli_fetch_array($rescnt);
			$query = "SELECT regno,rollno,name,gpa FROM semester".$semester." WHERE batch = '$batch' and department = '$department' ";
//			echo "<input type='text' style='display:none' name='startrow' value='$startrow' >";
			$resource = mysqli_query($con,$query) or die(mysqli_error($con));
			$subqry = "SELECT subcdt FROM subject WHERE batch = '$batch' and department = '$department' ";
			$subrsc = mysqli_query($con,$subqry) or die(mysqli_error($con));
			$num=mysqli_num_rows($resource);
			if($semester==1)
			{
			if($num>0)
			{
				echo "<table border ='1' align='center' id='dataTable' >"; 
				echo "<tr><th>Reg No</th><th>Roll No</th><th>Name</th><th>sem1</th><th>CGP</th></tr>";
					$row=mysqli_fetch_array($resource);
					$subrow=mysqli_fetch_array($subrsc);

					$rowcdt=unserialize($subrow['subcdt']);
					$getgpa=unserialize($row['gpa']);
					$size=sizeof($getgpa);
			}
			}
			if($semester==2)
			{
			if($num>0)
			{
				echo "<table border ='1' align='center' id='dataTable' >"; 
				echo "<tr><th>Reg No</th><th>Roll No</th><th>Name</th><th>sem1</th><th>sem2</th><th>CGP</th></tr>";
					$row=mysqli_fetch_array($resource);
					$subrow=mysqli_fetch_array($subrsc);

					//		$rowcdt=unserialize($subrow['subcdt']);
					$getgpa=unserialize($row['gpa']);
					$size=sizeof($getgpa);
			}
			}
			if($semester==3)
			{
			if($num>0)
			{
				echo "<table border ='1' align='center' id='dataTable' >"; 
				echo "<tr><th>Reg No</th><th>Roll No</th><th>Name</th><th>sem1</th><th>sem2</th><th>sem3</th><th>CGP</th></tr>";
					$row=mysqli_fetch_array($resource);
					$subrow=mysqli_fetch_array($subrsc);
					//$rowcdt=unserialize($subrow['subcdt']);
					$getgpa=unserialize($row['gpa']);
					$size=sizeof($getgpa);
			}
			}
			if($semester==4)
			{
			if($num>0)
			{
				echo "<table border ='1' align='center' id='dataTable' >"; 
				echo "<tr><th>Reg No</th><th>Roll No</th><th>Name</th><th>sem1</th><th>sem2</th><th>sem3</th><th>sem4</th><th>CGP</th></tr>";
					$row=mysqli_fetch_array($resource);
					$subrow=mysqli_fetch_array($subrsc);
					$rowcdt=unserialize($subrow['subcdt']);
					$getgpa=unserialize($row['gpa']);
					$size=sizeof($getgpa);
			}
			}
			if($semester==5)
			{
			if($num>0)
			{
				echo "<table border ='1' align='center' id='dataTable' >"; 
				echo "<tr><th>Reg No</th><th>Roll No</th><th>Name</th><th>sem1</th><th>sem2</th><th>sem3</th><th>sem4</th><th>sem5</th><th>CGP</th></tr>";
					$row=mysqli_fetch_array($resource);
					$subrow=mysqli_fetch_array($subrsc);
					$rowcdt=unserialize($subrow['subcdt']);
					$getgpa=unserialize($row['gpa']);
					$size=sizeof($getgpa);
			}
			}
			if($semester==6)
			{
			if($num>0)
			{
				echo "<table border ='1' align='center' id='dataTable' >"; 
				echo "<tr><th>Reg No</th><th>Roll No</th><th>Name</th><th>sem1</th><th>sem2</th><th>sem3</th><th>sem4</th><th>sem5</th><th>sem6</th><th>CGP</th></tr>";
					$row=mysqli_fetch_array($resource);
					$subrow=mysqli_fetch_array($subrsc);
					$rowcdt=unserialize($subrow['subcdt']);
					$getgpa=unserialize($row['gpa']);
					$size=sizeof($getgpa);
			}
			}
			if($semester==7)
			{
			if($num>0)
			{
				echo "<table border ='1' align='center' id='dataTable' >"; 
				echo "<tr><th>Reg No</th><th>Roll No</th><th>Name</th><th>sem1</th><th>sem2</th><th>sem3</th><th>sem4</th><th>sem5</th><th>sem6</th><th>sem7</th><th>CGP</th></tr>";
					$row=mysqli_fetch_array($resource);
					$subrow=mysqli_fetch_array($subrsc);
					$rowcdt=unserialize($subrow['subcdt']);
					$getgpa=unserialize($row['gpa']);
					$size=sizeof($getgpa);
			}
			}
			if($semester==8)
			{
			if($num>0)
			{
				echo "<table border ='1' align='center' id='dataTable' >"; 
				echo "<tr><th>Reg No</th><th>Roll No</th><th>Name</th><th>sem1</th><th>sem2</th><th>sem3</th><th>sem4</th><th>sem5</th><th>sem6</th><th>sem7</th><th>sem8</th><th>CGP</th></tr>";
					$row=mysqli_fetch_array($resource);
					$subrow=mysqli_fetch_array($subrsc);
					$rowcdt=unserialize($subrow['subcdt']);
					$getgpa=unserialize($row['gpa']);
					$size=sizeof($getgpa);
			}
			}
			for($z=1;$z<=$semester;$z++)
			{
			$quer = "SELECT regno,rollno,name,gpa FROM semester".$z." WHERE batch = '$batch' and department = '$department' ";
			$resour = mysqli_query($con,$quer) or die(mysqli_error($con));
			$cdtqry = "SELECT * FROM subject WHERE batch = '$batch' and department = '$department' and semester = '$z' ";
			$cdtres = mysqli_query($con,$cdtqry) or die(mysqli_error($con));
			$row = mysqli_fetch_array($cdtres);
			$rowcdt=unserialize($row['subcdt']);
			$j=0;
				$gpa=0;
				$rowmrk=0;
				$mycdt=0;
				while($rowmks=mysqli_fetch_array($resour))
					{
					$gpatot=0;
					$cdttot=0;
@					$rowmrk=unserialize($rowmks['gpa']);
						for($i=0;$i<$size;$i++)
							{
							
							if(@ $rowmrk[$i] == 'S')
							$rowgpa[$i] = 10;
							if(@ $rowmrk[$i] == 'A')
							$rowgpa[$i] = 9;
							if(@ $rowmrk[$i] == 'B')
							$rowgpa[$i] = 8;
							if(@ $rowmrk[$i] == 'C')
							$rowgpa[$i] = 7;
							if(@ $rowmrk[$i] == 'D')
							$rowgpa[$i] = 6;
							if(@ $rowmrk[$i] == 'E')
							$rowgpa[$i] = 5;
							if(@ $rowmrk[$i] == 'U')
							$rowgpa[$i] = 0;
							}
							$row[$j]=$rowmrk;
						for($i=0;$i<$size;$i++)
							{
					@		$subcdt[$i]=$rowgpa[$i]*$rowcdt[$i];
					@		$gpatot=$gpatot+$subcdt[$i];
					@		$cdttot=$cdttot+$rowcdt[$i];
							}
							$totgpa[$z][$j]=$gpatot;
							$totcdt[$z][$j]=$cdttot;
							$dummy[$z][$j]=$gpatot/$cdttot;
							$mygpa[$z][$j]=round($dummy[$z][$j],3);
						//	$mygpa[$z][$j]=$dummy[$z][$j];
							$j++;
					}
			}
			for($u=0;$u<$num;$u++)
			{
				
				for($v=1;$v<=$semester;$v++)
				{
				if($semester==1)
				{
				$cgp[$u]=$totgpa[1][$u]/$totcdt[1][$u];
				$mycgp[$u]=round($cgp[$u],3);
					
				}
				if($semester==2)
				{
				$cgp[$u]=($totgpa[1][$u]+$totgpa[2][$u])/($totcdt[1][$u]+$totcdt[2][$u]);
				$mycgp[$u]=round($cgp[$u],3);
					
				}
				if($semester==3)
				{
				$cgp[$u]=($totgpa[1][$u]+$totgpa[2][$u]+$totgpa[3][$u])/($totcdt[1][$u]+$totcdt[2][$u]+$totcdt[3][$u]);
				$mycgp[$u]=round($cgp[$u],3);
					
				}
				if($semester==4)
				{
				$cgp[$u]=($totgpa[1][$u]+$totgpa[2][$u]+$totgpa[3][$u]+$totgpa[4][$u])/($totcdt[1][$u]+$totcdt[2][$u]+$totcdt[3][$u]+$totcdt[4][$u]);
				$mycgp[$u]=round($cgp[$u],3);
				}
				if($semester==5)
				{
				$cgp[$u]=($totgpa[1][$u]+$totgpa[2][$u]+$totgpa[3][$u]+$totgpa[4][$u]+$totgpa[5][$u])/($totcdt[1][$u]+$totcdt[2][$u]+$totcdt[3][$u]+$totcdt[4][$u]+$totcdt[5][$u]);
				$mycgp[$u]=round($cgp[$u],3);
				}
				if($semester==6)
				{
				$cgp[$u]=($totgpa[1][$u]+$totgpa[2][$u]+$totgpa[3][$u]+$totgpa[4][$u]+$totgpa[5][$u]+$totgpa[6][$u])/($totcdt[1][$u]+$totcdt[2][$u]+$totcdt[3][$u]+$totcdt[4][$u]+$totcdt[5][$u]+$totcdt[6][$u]);
				$mycgp[$u]=round($cgp[$u],3);
				}
				if($semester==7)
				{
				$cgp[$u]=($totgpa[1][$u]+$totgpa[2][$u]+$totgpa[3][$u]+$totgpa[4][$u]+$totgpa[5][$u]+$totgpa[6][$u]+$totgpa[7][$u])/($totcdt[1][$u]+$totcdt[2][$u]+$totcdt[3][$u]+$totcdt[4][$u]+$totcdt[5][$u]+$totcdt[6][$u]+$totcdt[7][$u]);
				$mycgp[$u]=round($cgp[$u],3);
				}
				if($semester==8)
				{
				$cgp[$u]=($totgpa[1][$u]+$totgpa[2][$u]+$totgpa[3][$u]+$totgpa[4][$u]+$totgpa[5][$u]+$totgpa[6][$u]+$totgpa[7][$u]+$totgpa[8][$u])/($totcdt[1][$u]+$totcdt[2][$u]+$totcdt[3][$u]+$totcdt[4][$u]+$totcdt[5][$u]+$totcdt[6][$u]+$totcdt[7][$u]+$totcdt[8][$u]);
				$mycgp[$u]=round($cgp[$u],3);
				}
				}
			}
			$quer = "SELECT regno,rollno,name,gpa FROM semester".$semester." WHERE batch = '$batch' and department = '$department' ";
			$resour = mysqli_query($con,$quer) or die(mysqli_error($con));
			$i=0;
			$s=1;
	while($rowt=mysqli_fetch_array($resour))
	{	
if($semester==1)			
	echo " <tr><td> ".$rowt['regno']." </td><td> ".$rowt['rollno']." </td><td> ",$rowt['name']." </td><td> ".$mygpa[$s][$i]." </td><td>".$mycgp[$i]."</td></tr>";
if($semester==2)			
	echo " <tr><td> ".$rowt['regno']." </td><td> ".$rowt['rollno']." </td><td> ",$rowt['name']." </td><td> ".$mygpa[$s][$i]." </td><td> ".$mygpa[$s+1][$i]." </td><td>".$mycgp[$i]."</td></tr>";
if($semester==3)			
	echo " <tr><td> ".$rowt['regno']." </td><td> ".$rowt['rollno']." </td><td> ",$rowt['name']." </td><td> ".$mygpa[$s][$i]." </td><td> ".$mygpa[$s+1][$i]." </td><td> ".$mygpa[$s+2][$i]." </td><td>".$mycgp[$i]."</td></tr>";
if($semester==4)			
	echo " <tr><td> ".$rowt['regno']." </td><td> ".$rowt['rollno']." </td><td> ",$rowt['name']." </td><td> ".$mygpa[$s][$i]." </td><td> ".$mygpa[$s+1][$i]." </td><td> ".$mygpa[$s+2][$i]." </td><td> ".$mygpa[$s+3][$i]." </td><td>".$mycgp[$i]."</td></tr>";
if($semester==5)			
	echo " <tr><td> ".$rowt['regno']." </td><td> ".$rowt['rollno']." </td><td> ",$rowt['name']." </td><td> ".$mygpa[$s][$i]." </td><td> ".$mygpa[$s+1][$i]." </td><td> ".$mygpa[$s+2][$i]." </td><td> ".$mygpa[$s+3][$i]." </td><td> ".$mygpa[$s+4][$i]." </td><td>".$mycgp[$i]."</td></tr>";
if($semester==6)			
	echo " <tr><td> ".$rowt['regno']." </td><td> ".$rowt['rollno']." </td><td> ",$rowt['name']." </td><td> ".$mygpa[$s][$i]." </td><td> ".$mygpa[$s+1][$i]." </td><td> ".$mygpa[$s+2][$i]." </td><td> ".$mygpa[$s+3][$i]." </td><td> ".$mygpa[$s+4][$i]." </td><td> ".$mygpa[$s+5][$i]." </td><td>".$mycgp[$i]."</td></tr>";
if($semester==7)			
	echo " <tr><td> ".$rowt['regno']." </td><td> ".$rowt['rollno']." </td><td> ",$rowt['name']." </td><td> ".$mygpa[$s][$i]." </td><td> ".$mygpa[$s+1][$i]." </td><td> ".$mygpa[$s+2][$i]." </td><td> ".$mygpa[$s+3][$i]." </td><td> ".$mygpa[$s+4][$i]." </td><td> ".$mygpa[$s+5][$i]." </td><td> ".$mygpa[$s+6][$i]." </td><td>".$mycgp[$i]."</td></tr>";
if($semester==8)			
	echo " <tr><td> ".$rowt['regno']." </td><td> ".$rowt['rollno']." </td><td> ",$rowt['name']." </td><td> ".$mygpa[$s][$i]." </td><td> ".$mygpa[$s+1][$i]." </td><td> ".$mygpa[$s+2][$i]." </td><td> ".$mygpa[$s+3][$i]." </td><td> ".$mygpa[$s+4][$i]." </td><td> ".$mygpa[$s+5][$i]." </td><td> ".$mygpa[$s+6][$i]." </td><td> ".$mygpa[$s+7][$i]." </td><td>".$mycgp[$i]."</td></tr>";

	echo "<script>i++;document.getElementById('count').value=i;</script>";
	$i++;
	}
//	$prev = $startrow - 10;
//	echo "<script> prev = $prev; startrow = $startrow;</script>";
//	if ($prev >= 0)
//    echo '<tr><td><a href="#" class="prev">Previous</a></td><td></td>';
//	$strow=$startrow+10;
//	if($strow < $count[0])
//	echo '<td><a href="#" class="next">Next</a></td><td></td></tr>';
	echo "</table>";
	}
	}
	?>
<input type="text" style="display:none;position:absolute;" name="count" id="count"/>
</form>
</div>
<?php
if(isset($_GET['dept']) && isset($_GET['batch']) && isset($_GET['sem']))
{
?>
<div style="text-align:center">  
    <input type="submit" id="submit" name="submit">  
</div>  
<?php } ?>
<div id='loading' align="center" style='display: none'><img src="ajax-loader.gif" title="Loading" /></div>
<script>
$(document).ready(function()
				  {
				  $('#dept').on( 'change', function() 
								{         
								var dept = $("form").serializeArray();
								$.ajax({
									   type: "GET",
									   url:"semexm.php",
									   data:dept,
									   success: function(result) 
									   {
									   
									   $("#txtHint").html(result);
									   $("#txtHint").show();
									   
									   }
									   })
								});
				  $('#batch').on( 'change', function() 
								 {         
								 var batch = $("form").serializeArray();
								 $.ajax({
										type: "GET",
										url:"semexm.php",
										data:batch,
										success: function(result) 
										{
										
										$("#txtHint").html(result);
										$("#txtHint").show();
										
										}
										})
								 });
				  $('#sem').on( 'change', function() 
							   {       
  							   var sem = $("form").serializeArray();
							   $.ajax({									  
									  type: "GET",
									  url:"semexm.php",
									  data:sem,									  
									  success: function(result) 
									  {
									  
									  $("#txtHint").html(result);
									  $("#txtHint").show();
									  
									  }
									  })
							   });
                    $('.next').click( function()
								   {
								   startrow=startrow+10;
								   $.ajax({
										  type: "GET",
										  url:"semexm.php",
										  data:"dept="+document.getElementById("dept").value+"&batch="+document.getElementById("batch").value+"&sem="+document.getElementById("sem").value+"&sbj="+document.getElementById("subj").value+"&test="+document.getElementById("test").value+"&startrow="+startrow,
										  success: function(result) 
										  {
										  
										  $("#txtHint").html(result);
										  $("#txtHint").show();
										  
										  }
										  })
								   });
				  $('.prev').click( function()
								   {
								   var submit = $("form").serialize();
								   prev=startrow-10;
								   $.ajax({
										  type: "GET",
										  url:"semexm.php",
										  data:submit+"&startrow="+prev,
										  success: function(result) 
										  {
										  
										  $("#txtHint").html(result);
										  $("#txtHint").show();
										  
										  }
										  })
								   });
					
						$('#submit').click( function()
								   {
									var loadingdiv = document.getElementById('loading');
								  	loadingdiv.style.display = "block";
								   	var submit = $("form").serialize();
								   $.ajax({
										  type: "GET",
										  url:"semexm.php",
										  data:submit+"&submit="+1,
										  success: function(result) 
										  {
										  var loadingdiv = document.getElementById('loading');
										  loadingdiv.style.display = "none";
										  $("#txtHint").html(result);
										  $("#txtHint").show();
										  
										  }
										  })
								   });
				  });
</script>
</body>
</html>