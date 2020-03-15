<?php

	
	$con=mysqli_connect('localhost','root','','ems');
	session_start();
	if(isset($_POST['sign']))
	{
		
		//$name=$_POST['name'];
		//$mobile=$_POST['mobile'];
		//$email=$_POST['email'];
		//$password=$_POST['pwd'];
		//$role=$_POST['role'];
		
	function newsign($name,$mobile,$email,$password,$role)
	{
		
		$con=mysqli_connect('localhost','root','','ems');
		
		if(!empty($role))
		{
			if(!empty($name))
			{
				if(!empty($mobile))
				{
					if(!empty($email))
					{
						if(!empty($password))
						{
							$sql="SELECT Email FROM main WHERE Email='$email'";
							$res=mysqli_query($con,$sql);
							$row=mysqli_fetch_array($res);
							$ec=$row['Email'];
						
						
							if($ec!=$email)
							{	

								$sql="SELECT Mobile FROM main WHERE Mobile='$mobile'";
								$res=mysqli_query($con,$sql);
								$row=mysqli_fetch_array($res);
								$mc=$row['Mobile'];
							
								if($mc!=$mobile)
								{	
							
									$sql="INSERT INTO main(Name,Mobile,Email,Password,Role) values('$name','$mobile','$email','$password','$role');";
									$res=mysqli_query($con,$sql);
							
									if($res=true)
									{
										header('Location:http://localhost/ems/index.php?mas=Registration Completed, Try to Log In');
									}
									else 
									{
										header('Location:http://localhost/ems/sign.php?mas=Error');
									}
								}
								else
								{	
									header('Location:http://localhost/ems/sign.php?mas=Phone Number already exist.');	
								}
							}
							else
							{	
								header('Location:http://localhost/ems/sign.php?mas=Email ID already exist.');	
							}
						}
						else
						{
							header('Location:http://localhost/ems/sign.php?mas=Password is mandatory please fill this');
						}	
					}
					else
					{
							header('Location:http://localhost/ems/sign.php?mas=Email is mandatory please fill this');
					}
				}
				else
				{
					header('Location:http://localhost/ems/sign.php?mas=Mobile Number is mandatory please fill this');
					
				}
			}
			else
			{
					header('Location:http://localhost/ems/sign.php?mas=Name is mandatory please fill this');
			}
			
		}
		else
		{
			header('Location:http://localhost/ems/sign.php?mas=Selection of Membership Type is Mandatory');
		}
	}
		
		newsign($_POST['name'],$_POST['mobile'],$_POST['email'],$_POST['pwd'],$_POST['role']);
	}
	
	else if(isset($_POST['log']))
	{
		//$email = $_POST['email'];
		//$password = $_POST['pwd'];
		
		
	
	function newlogin($email,$password)
	{
		
		$con=mysqli_connect('localhost','root','','ems');
		
		function email_validation($str) { 
			return (!preg_match( 
			'^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^', $str)) 
			? FALSE : TRUE; 
			} 
		if(!empty($email))
		{
			if(email_validation($email))
			{ 
				
			 
			
			if(!empty($password))
			{
				$sql="SELECT * FROM main WHERE Email='$email'";
				$res=mysqli_query($con,$sql);
				$row=mysqli_fetch_array($res);
				$e=$row['Email'];
			
				if($email==$e)
				{
					$sql="SELECT * FROM main WHERE Email='$email' AND Password='$password'";
				    $res=mysqli_query($con,$sql);
                    $row=mysqli_fetch_array($res);
					$p=$row['Password'];
					$uid=$row['ID'];
					$_SESSION['uid']=$uid;
					
					
					if($password==$p)
					{
						$sql="SELECT * FROM main WHERE ID=".$_SESSION['uid']."";
						$res=mysqli_query($con,$sql);
						$row=mysqli_fetch_array($res);
						$role=$row['Role'];
						$_SESSION['r']=$role;
						
						
						{
							require 'profile.php';
						}
					}
					
					else
					{
						header('Location:http://localhost/ems/index.php?mas=Password entered in INCORRECT, Try again.');
					}
				}
				else
				{
					header('Location:http://localhost/ems/index.php?mas=Email entered in INCORRECT, Try again.'.$e.'');
				}

			}
			else
			{
				header('Location:http://localhost/ems/index.php?mas=Password is mandatory please fill this');
			}
			}
			else
			{
				header('Location:http://localhost/ems/index.php?mas=Wrong Email Format');
			}
		}
		else
		{
			header('Location:http://localhost/ems/index.php?mas=Email is mandatory please fill this');
		}
	}
		newlogin($_POST['email'],$_POST['pwd']);
	}
	
	elseif(isset($_GET['logout']))
	{
		session_unset();
		session_destroy();
		require 'index.php';
	}
	
	if(isset($_GET['page']))
	{
		$id=$_SESSION['uid'];
		if(!empty($id))
		{
			$p=$_GET['page'];
			
			if($p=='profile')
			{
				require 'profile.php';
			}
			else if($p=='feedback')
			{
				require 'feedback.php';
			}
			else if($p=='feedbackreport')
			{
				require 'feedback_report.php';
			}
			else if($p=='chistory')
			{
				require 'course_history.php';
			}
			else if($p=='gencourse')
			{
				require 'gencourse.php';
			}
			else if($p=='pref')
			{
				require 'preference.php';
			}
			else if($p=='export')
			{
				require 'export.php';
			}
			else if($p=='import')
			{
				require 'import.php';
			}
			
		}
		else
		{
			require 'login.php'; 
		}
	}
	
	if(isset($_POST['feed']))
	{
		if(!empty($_SESSION['uid']))
		{ 
			function feedback($text_area)
			{
				$con=mysqli_connect('localhost','root','','ems');
					//$role=$_POST['roles'];
					//$text_area=$_POST['text_area'];
					
					$sql="INSERT INTO feedback_report(Feedback) values('$text_area');";
				    $res=mysqli_query($con,$sql);
				   
				   require 'feedback.php';
			}
			if(isset($_POST['text_area']))
			{
				
				feedback($_POST['text_area']);
			}
		}
		else
		{
			require'login.php';
		}
	}
	
	/*CREATING THE COURSE*/
	if(isset($_POST['gen_it']))
	{
		if(!empty($_SESSION['uid']))
		{
			
			
					$c_head=$_POST['c_head'];
					$max=$_POST['max'];
					$text_area=$_POST['text_area'];
					
					$sql="INSERT INTO course(Cname,Cdetails,Max) values('$c_head','$text_area','$max');";
				    $res=mysqli_query($con,$sql);
					
					$u='dd';
					
					
					$sql="SELECT count(CID) AS cr from course;";
					$res=mysqli_query($con,$sql);
					$row=mysqli_fetch_assoc($res);
					$c=$row['cr'];
					
				    //$res=mysqli_query($con,$sql);
					//echo $row;
					
					//echo $c;
					//$row = mysql_fetch_array($res);
					//$c=$row['c'];
					if($c==1)
					{
						$sql1="ALTER TABLE preference ADD Elec1 int;";
						$res1=mysqli_query($con,$sql1);
						require 'gencourse.php';
					}
					
					if($c==2)
					{
						$sql1="ALTER TABLE preference ADD Elec2 int;";
						$res1=mysqli_query($con,$sql1);
						require 'gencourse.php';
					}
					if($c==3)
					{
						$sql1="ALTER TABLE preference ADD Elec3 int;";
						$res1=mysqli_query($con,$sql1);
						require 'gencourse.php';
					}
					if($c==4)
					{
						$sql1="ALTER TABLE preference ADD Elec4 int;";
						$res1=mysqli_query($con,$sql1);
						require 'gencourse.php';
					}
					if($c==5)
					{
						$sql1="ALTER TABLE preference ADD Elec5 int;";
						$res1=mysqli_query($con,$sql1);
						require 'gencourse.php';
					}
					
					
					
					
					//$cid = 4;
					//echo $cid;
					//$sql1="ALTER TABLE preference ADD $cid int;";
					//$res1=mysqli_query($con,$sql1);
					//echo $res1;
				    //require 'gencourse.php';
				
		}
		else
		{
			require'login.php';
		}
	}
	
	/* EDIT INFO */
	elseif(isset($_GET['edit']))
	{
		require 'editinfo.php';
	}
	
	/* UPDATE INFO */
	else if(isset($_POST['update']))
	{
		$email = $_POST['email'];
		$name = $_POST['name'];
		$mobile = $_POST['mobile'];
		
		
		$sql="UPDATE main SET Name='$name', Email='$email' ,Mobile='$mobile' where ID=".$_SESSION['uid']."";
		$res=mysqli_query($con,$sql);
			
			require 'profile.php';
	}
	
	/*UPLOADING PROFILE PICTURE*/
	if(isset($_POST['upload']))
	{
		$id=$_SESSION['uid'];
		if(!empty($id))
		{
			$targetfile="img/".basename($_FILES["p_img"]["name"]);
			$imageFileType = strtolower(pathinfo($targetfile,PATHINFO_EXTENSION));
			
			$sql = "UPDATE main SET image='$targetfile' WHERE ID=".$_SESSION['uid']."";
			$res=mysqli_query($con,$sql);
			move_uploaded_file($_FILES["p_img"]["tmp_name"],$targetfile);
			require 'profile.php';
		}
		else
		{
			require 'login.php';
		}
	}
	
	/*SUBMIT PREFERENCES*/
	if(isset($_POST['submit_pref']))
	{
		if(!empty($_SESSION['uid']))
		{
			$cc = $_GET['cc'];
			$uid = $_SESSION['uid'];
			//var_dump($_POST);
			
			$p1 = $_POST['cname1'];
			$p2 = $_POST['cname2'];
			$p3 = $_POST['cname3'];
			$p4 = $_POST['cname4'];
			$p5 = $_POST['cname5'];
			if($p1!=$p2 and $p1!=$p3 and $p1!=$p4 and $p1!=$p5 and $p1!=$p3 and $p2!=$p3 and $p2!=$p4 and $p2!=$p5 and $p3!=$p4 and $p3 != $p5 and $p4 != $p5 and $p1!=0 and $p2!=0 and $p3!=0 and $p4!=0 and $p5!=0  )
			{
			if($cc==2)
			{
				$sql="INSERT INTO preference(SID,Elec1,Elec2) values('$uid','$p1','$p2')";
				$res=mysqli_query($con,$sql);
					
			}
			if($cc==3)
			{
				$sql="INSERT INTO preference(SID,Elec1,Elec2,Elec3) values('$uid','$p1','$p2','$p3')";
				$res=mysqli_query($con,$sql);
					
			}
			if($cc==4)
			{
				$sql="INSERT INTO preference(SID,Elec1,Elec2,Elec3,Elec4) values('$uid','$p1','$p2','$p3','$p4')";
				$res=mysqli_query($con,$sql);
					
			}
			if($cc==5)
			{
				$sql="INSERT INTO preference(SID,Elec1,Elec2,Elec3,Elec4,ELec5) values('$uid','$p1','$p2','$p3','$p4','$p5')";
				$res=mysqli_query($con,$sql);
					
			}
			
			
				 
				  require 'course_history.php';
			}
			else
			{
				header('Location:http://localhost/ems/preference.php?mas=Enter Unique value for each preference');
			}
			
		}
		else
		{
			require'login.php';
		}
	}//C:\xampp\htdocs\ems\data
	
	//EXPORT
	if(isset($_POST['export']))
	{
		if(!empty($_SESSION['uid']))
		{
		
				//get records from database
				$query = $con->query("SELECT * FROM preference");

				if($query->num_rows > 0)
				{
					$delimiter = ",";
					$filename = "preference.csv";
					
					//create a file pointer
					//$f = fopen('php://memory', 'w');
					$f = fopen('preference.csv', 'w');
					
					//set column headers
					$fields = array('SID', 'Elec1', 'Elec2', 'Elec3', 'Elec4', 'Elec5');
					fputcsv($f, $fields, $delimiter);
					
					//output each row of the data, format line as csv and write to file pointer
					while($row = $query->fetch_assoc()){
						//$status = ($row['status'] == '1')?'Active':'Inactive';
						$lineData = array($row['SID'], $row['Elec1'], $row['Elec2'], $row['Elec3'], $row['Elec4'], $row['Elec5']);
						//fputcsv($f, $lineData, $delimiter);
						fputcsv($f, $lineData, $delimiter);
					}
					
					//move back to beginning of file
					fseek($f, 0);
					//set headers to download file rather than displayed
					header('Content-Type: text/csv');
					header('Content-Disposition: attachment; filename="' . $filename . '";');
					
					
					//output all remaining data on a file pointer
					fpassthru($f);
			
			require 'export.php'; 
				}
		}
		else
		{
			require'login.php';
		}
	}
	
	//IMPORT

	if(isset($_POST['importSubmit']))
	{
		if(!empty($_SESSION['uid']))
		{
		
		// Allowed mime types
		$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		
		// Validate whether selected file is a CSV file
		if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
			
			// If the file is uploaded
			if(is_uploaded_file($_FILES['file']['tmp_name'])){
				
				// Open uploaded CSV file with read-only mode
				$csvFile = fopen($_FILES['file']['tmp_name'], 'r');
				
				// Skip the first line
				fgetcsv($csvFile);
				
				// Parse data from CSV file line by line
				while(($line = fgetcsv($csvFile)) !== FALSE){
					// Get row data
					$sid  = $line[0];
					$cid  = $line[1];
					
					// Check whether member already exists in the database with the same email
					
						// Insert member data in the database
						//$con->query("INSERT INTO allocated (SID, CID) VALUES ('$sid', '$cid');");
						
						// Check whether member already exists in the database with the same email
					$prevQuery = "SELECT SID FROM allocated1 WHERE SID = '".$line[0]."'";
					$prevResult = $con->query($prevQuery);
					
					if($prevResult->num_rows > 0){
						// Update member data in the database
						$con->query("UPDATE allocated1 SET SID = '".$sid."', CID = '".$cid."' WHERE SID = '".$sid."'");
					}else{
						// Insert member data in the database
						$con->query("INSERT INTO allocated1 (SID, CID) VALUES ('".$sid."', '".$cid."');");
					}
				
					
				}
				
				// Close opened CSV file
				fclose($csvFile);
				
				$qstring = '?status=succ';
			}else{
				$qstring = '?status=err';
			}
		}else{
			$qstring = '?status=invalid_file';
		}
		


		}
		// Redirect to the listing page
		header("Location: import.php".$qstring);
		//else
		//{
			//require'login.php';
		//}
	}
	
	if(isset($_POST['cally']))
	{
		exec("allocateelective.py");
		require 'import.php';
	}
	
	
	//MAX SIZE
	if(isset($_POST['export_max']))
	{
		if(!empty($_SESSION['uid']))
		{
		
				//get records from database
				$query = $con->query("SELECT Max FROM course");

				if($query->num_rows > 0)
				{
					$delimiter = ",";
					$filename = "max.csv";
					
					//create a file pointer
					//$f = fopen('php://memory', 'w');
					$f = fopen('max.csv', 'w');
					
					//set column headers
					$fields = array('Max');
					fputcsv($f, $fields, $delimiter);
					
					//output each row of the data, format line as csv and write to file pointer
					while($row = $query->fetch_assoc()){
						
						$lineData = array($row['Max']);
						//fputcsv($f, $lineData, $delimiter);
						fputcsv($f, $lineData, $delimiter);
					}
					
					//move back to beginning of file
					fseek($f, 0);
					//set headers to download file rather than displayed
					//header('Content-Type: text/csv');
					//header('Content-Disposition: attachment; filename="' . $filename . '";');
					
					
					//output all remaining data on a file pointer
					fpassthru($f);
			
			require 'export.php'; 
				}
		}
		else
		{
			require'login.php';
		}
	}
	

	
	