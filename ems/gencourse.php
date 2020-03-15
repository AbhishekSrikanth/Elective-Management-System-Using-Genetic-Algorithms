<?php 
	
	$r=$_SESSION['r'];
if($r=='prof')
{
	include 'profheader.php';
	//$sql="SELECT * FROM category_details ";
	//$res=mysqli_query($con,$sql);

}
#elseif($r=='blogger')
#{
#	include 'bloggerheader.php';
#	$sql="SELECT * FROM category_details ";
#	$res=mysqli_query($con,$sql);
#}






					

					
?>

	<div class=" container well   vert-offset-top-6">
		<form  class="" action="Db.php" method="post" enctype="multipart/form-data">
			
			<div class="form-group col-md-6 col-md-offset-3 vert-offset-top-3 vert-offset-bottom-3">
				<h3 class="text-center"><strong>Create Course</strong></h3>
			</div>
			
			
			<div class="form-group col-md-6 col-md-offset-3">
				<label>Course Header :</label>
				<input type="text"  class="form-control" name="c_head">
			</div>
			
			
			
			
	
			
			<div class="form-group col-md-6 col-md-offset-3">
				<label for="textarea">Course Description : </label>
				<textarea id="textarea" name="text_area" class="form-control" rows="6"></textarea>
			</div>
			
			<div class="form-group col-md-6 col-md-offset-3">
				<label>Maximum Capacity :</label>
				<input type="text"  class="form-control" name="max">
			</div>
			
			<div class="form-group col-md-3 col-md-offset-5">
				<input type="submit" name="gen_it" class="btn btn-info" value="Add Course Preference">
			</div>
			
		</form>
		
	</div>


