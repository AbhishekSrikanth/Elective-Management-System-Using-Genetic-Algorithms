<?php 
	
	$r='student';

	$con=mysqli_connect('localhost','root','','ems');
		include 'userheader.php';
	
	$sql1="SELECT * FROM course";	#WHERE CID='$id' ";
	$res1=mysqli_query($con,$sql1);
	$row1=mysqli_fetch_array($res1);
	
						
	$count =1;
	$cc=0;
	$c='c';

	foreach($res1 as $row)
		{
			$cc = $cc +1;
		} 						
	$msg="";
	
	if(isset($_GET['mas']))
	{
		$msg = $_GET['mas'];
	}
					
?>
<div class="container jumbotron " >
<div class="form-group col-md-6 col-md-offset-3 vert-offset-top-3 vert-offset-bottom-3">
				<h3 class="text-center"><strong>Select your Preference</strong></h3>
	<?php if(!empty($msg)){ ?>
	<div class="col-xs-12">
		<div class="alert alert-danger"><?php echo $msg; ?></div>
	</div>
	<?php } ?>		
</div>

<form  class="" action="db.php?cc=<?php echo $cc; ?>&submit" method="post">
			<?php
					foreach($res1 as $row)
					{
						
							$cid=$row['CID'];
							$cname=$row['Cname'];
							$max=$row['Max'];
							$c='c';
							//$co = chr($count);
							
							//$b_desc=$row['B_Desc'];
							
							//$u_id=$row['U_ID'];
							
							//$sql2="SELECT * FROM emp_details WHERE ID='$u_id' ";
							//$res2=mysqli_query($con,$sql2);
							//$row1=mysqli_fetch_array($res2);
							//$name=$row1['Name'];
							
							//$sql="SELECT * FROM category_details WHERE C_ID='$c_id' ";
							//$res=mysqli_query($con,$sql);
							//$row=mysqli_fetch_array($res);
							//$category=$row['C_Name'];
							
							//$_SESSION['uid']=$uid;
							if($count==1 and $count<=$cc)
							{
								$cname1 = $cname;
								$cid1 = $cid;
								$max1 = $max;
							}
							if($count==2 and $count<=$cc)
							{
								$cname2 = $cname;
								$cid2 = $cid;
								$max2 = $max;
								
							}
							if($count==3 and $count<=$cc)
							{
								$cname3 = $cname;
								$cid3 = $cid;
								$max3 = $max;
							}
							if($count==4 and $count<=$cc)
							{
								$cname4 = $cname;
								$cid4 = $cid;
								$max4 = $max;
							}
							if($count==5 and $count<=$cc)
							{
								$cname5 = $cname;
								$cid5 = $cid;
								$max5 = $max;
							}
				$count = $count +1;	
					}				
			?>
			
			<?php 
			if(!empty($cid1))
			{?>
			<div class="form-group col-md-6 col-md-offset-3">
				
				<label ><?php echo $cname1; ?></label>
				<label  class="text-primary"> Total Seats : <?php echo $max1 ?></label>
				
				<input type="text"  class="form-control " name='cname1'>
			</div>
			
			
			<hr>		
			<?php
			}
			?>
			
			<?php 
			if(!empty($cid2))
			{?>
			<div class="form-group col-md-6 col-md-offset-3">
				<label ><?php echo $cname2; ?></label>
				<label  class="text-primary"> Total Seats : <?php echo $max2 ?></label>
				<input type="text"  class="form-control " name='cname2'>
			</div>
			
			
			<hr>		
			<?php
			}
			?>
			
			<?php 
			if(!empty($cid3))
			{?>
			<div class="form-group col-md-6 col-md-offset-3">
				<label ><?php echo $cname3; ?></label>
				<label  class="text-primary"> Total Seats : <?php echo $max3 ?></label>
				<input type="text"  class="form-control " name='cname3'>
			</div>
			
			
			<hr>		
			<?php
			}
			?>
			
			<?php 
			if(!empty($cid4))
			{?>
			<div class="form-group col-md-6 col-md-offset-3">
				<label ><?php echo $cname4; ?></label>
				<label  class="text-primary"> Total Seats : <?php echo $max4 ?></label>
				<input type="text"  class="form-control " name='cname4'>
			</div>
			
			
			<hr>		
			<?php
			}
			?>
			
			<?php 
			if(!empty($cid5))
			{?>
			<div class="form-group col-md-6 col-md-offset-3">
				<label ><?php echo $cname5; ?></label>
				<label  class="text-primary"> Total Seats : <?php echo $max5 ?></label>
				<input type="text"  class="form-control " name='cname5'>
			</div>
			
			
			<hr>		
			<?php
			}
			?>
			
			<div class="form-group col-md-3 col-md-offset-5">
				<input type="submit" name="submit_pref" class="btn btn-info" value="Submit Preferences">
			</div>
	</form>
</div>
