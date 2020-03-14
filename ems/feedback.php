<?php 
	
	$r=$_SESSION['r'];

	if($r=='prof')
	{
		include 'profheader.php';
		$sql="SELECT * FROM feedback_report ";
		$res=mysqli_query($con,$sql);
		
		$sql1="SELECT role FROM main ";
		$res1=mysqli_query($con,$sql1);
		

	}
	elseif($r=='student')
	{
		include 'userheader.php';
		$sql="SELECT * FROM feedback_report ";
		$res=mysqli_query($con,$sql);
		
		$sql1="SELECT * FROM main ";
		$res1=mysqli_query($con,$sql1);
		$row1=mysqli_fetch_array($res1);
		
		$role=$row1['Role'];
		
	}





					

					
?>

	<div class=" container well   vert-offset-top-6">
		<form  class="" action="db.php" method="post">
			
			<div class="form-group col-md-6 col-md-offset-3 vert-offset-top-3 vert-offset-bottom-3">
				<h3 class="text-center"><strong>Feedback Report</strong></h3>
			</div>
			
			
			<!--<div class="form-group col-md-6 col-md-offset-3">
				<label>Role :</label>
				<input type="text"  class="form-control" name="roles" value="<?php echo $role?>" >
				
			</div>-->

			<div class="form-group col-md-6 col-md-offset-3">
				<label for="textarea">Write Feedback : </label>
				<textarea id="textarea" name="text_area" class="form-control" rows="6"></textarea>
			</div>
			
			<div class="form-group col-md-3 col-md-offset-5">
				<input type="submit" name="feed" class="btn btn-info" value="Post">
			</div>
			
		</form>
		
	</div>


