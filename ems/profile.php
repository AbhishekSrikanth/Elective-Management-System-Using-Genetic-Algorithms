
<?php 

if($_SESSION['r']=='admin')
{
include 'adminheader.php';
}
elseif($_SESSION['r']=='prof')
{
	include 'profheader.php';
}
else
{
	include 'userheader.php';
}


$uid=$_SESSION['uid'];
                    $sql="SELECT * FROM main WHERE ID='$uid'";
				    $res=mysqli_query($con,$sql);
                    $row=mysqli_fetch_array($res);
					$name=$row['Name'];
					$mobile=$row['Mobile'];
					$email=$row['Email'];
					$img=$row['Image'];
					

					
?>
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 500px;
  
  margin: auto;
  text-align: center;
  font-family: arial;
 
 
}
.custom{
  margin-top:100px;
}
.custom1{
  margin-top:50px;
}
</style>
<title>Profile</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body class="bg-light text-dark">
<div class=" container  ">
  <div class="  card  custom  ">
  <div class="custom1">
					<img src="<?php echo $img;?>" class="img-responsive center-block " alt="" style="width:200px ;height:220px">
				</div>
 
  
  <!--<p><?php// echo $mobile;?></p>
  <p><?php// echo $email;?></p>-->
  <div class="profile-userbuttons ">
					<form action="db.php" method="post" enctype="multipart/form-data">
						<input class ="col-md-offset-4" type="file" name="p_img" accept="image/*">
						<input type="submit" name="upload" value="Upload" class="btn btn-success">
					</form>
  </div>
  <div class="profile-usermenu text-center">
					<ul class="nav">
						
						<li>
							<h4 >
							<i class="glyphicon glyphicon-user"></i>
							 <?php echo $name;?></h4>
						</li>
						<li>
							<h4>
							<i class="glyphicon glyphicon-phone"></i>
							 <?php echo $mobile;?> </h4>
						</li>
						<li>
							<h4>
							<i class="glyphicon glyphicon-envelope"></i>
							 <?php echo $email;?> </h4>
						</li>
						<li><a href="db.php?edit"><button type="button" name='edit_info'  class="btn btn-success btn-sm">Edit Info</button></li>
					</ul>
	</div>
  
  <a href="twitter.com"><i class="fa fa-twitter"></i></a>
  <a href="linkedin.com"><i class="fa fa-linkedin"></i></a>
  <a href="fb.com"><i class="fa fa-facebook"></i></a>
  
  </div>
</body>
</div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>