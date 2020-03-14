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
	elseif(isset($_GET['edit']))
	{
		require 'edit.php';
	}
	else if(isset($_POST['update']))
	{
		$email = $_POST['email'];
		$name = $_POST['name'];
		$mobile = $_POST['mobile'];
		
		
		$sql="UPDATE Emp_Details SET Name='$name', Email='$email' ,Mobile='$mobile' where ID=".$_SESSION['uid']."";
		$res=mysqli_query($con,$sql);
			
			require 'profile.php';
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
					
					$text_area=$_POST['text_area'];
					
					$sql="INSERT INTO course(Cname,Cdetails) values('$c_head','$text_area');";
				    $res=mysqli_query($con,$sql);
					
					$sql="SELECT CID from course where Cname = '.$c_head.';";
				    $res=mysqli_query($con,$sql);
					$row=mysqli_fetch_array($res);
					$cid=$row['CID'];
					$cid = 4;
					echo $cid;
					$sql1="ALTER TABLE preference ADD $cid int;";
					$res1=mysqli_query($con,$sql1);
					echo $res1;
				   // require 'gencourse.php';
				
		}
		else
		{
			require'login.php';
		}
	}
	
	/*SUBMIT PREFERENCES*/
	if(isset($_POST['submit_pref']))
	{
		if(!empty($_SESSION['uid']))
		{
			//$cc = $_GET['cc'];
			$uid = $_SESSION['uid'];
			var_dump($_POST);
			
			$p1 = $_POST['cname1'];
			$p2 = $_POST['cname2'];
			$p3 = $_POST['cname3'];
			$p4 = $_POST['cname4'];
			$p5 = $_POST['cname5'];
			echo $p1;
			
			$sql="INSERT INTO preference(SID,Pref1,Pref2,Pref3,Pref4,Pref5) values('$uid','$p1','$p2','$p3','$p4','$p5')";
			//$sql1="ALTER TABLE preference ADD $cid int;";
			$res=mysqli_query($con,$sql);
			
		
			//echo $uid;
			
			/*
			if(!empty($_POST['1']))
			{
				$p1 = $_POST['1'];
				echo $p1;
				$sql="INSERT INTO preference(Pref1) values('$p1')";
				
			}
			if(!empty($_POST['2']))
			{
				$p2 = $_POST['2'];
				$sql="INSERT INTO preference(Pref2) values('$p2')";
				
			}
			if(!empty($_POST['3']))
			{
				$p3 = $_POST['3'];
				$sql="INSERT INTO preference(Pref3) values('$p3')";
				
			}
			if(!empty($_POST['4']))
			{
				$p4 = $_POST['4'];
				$sql="INSERT INTO preference(Pref4) values('$p4')";
				
			}
			if(!empty($_POST['5']))
			{
				$p5 = $_POST['5'];
				$sql="INSERT INTO preference(Pref5) values('$p5')";
				
			}*/
			//for ($x = 0; $x <= $cc; $x++) {
			//	$sql="INSERT INTO preference(SID) values('$uid');
 
			//		$c_head=$_POST['1'];
					
			//		$text_area=$_POST['2'];
					
					//$sql="INSERT INTO course(Cname,Cdetails) values('$c_head','$text_area');";
				    //$res=mysqli_query($con,$sql);
				 
				 //  require 'course_history.php';
				
		}
		else
		{
			require'login.php';
		}
	}//C:\xampp\htdocs\ems\data
	
	//EXPORT
	if(isset($_POST['export']))
	{
		//$v=$_POST['check'];
		
				$sql = "SELECT * FROM preference INTO OUTFILE 'C:\xampp\htdocs\ems\data\preferences'
				FIELDS ENCLOSED BY '"' TERMINATED BY ';' ESCAPED BY '"' LINES TERMINATED BY '\r\n';";
				$res = mysqli_query($con,$sql);		
		
			require 'export.php'; 
	}

	