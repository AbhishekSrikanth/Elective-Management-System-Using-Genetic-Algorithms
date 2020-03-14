
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
					
					

					
?>
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 500px;
  
  margin: auto;
  text-align: center;
  font-family: arial;
  
}
</style>
<title>Profile</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body class="bg-light text-dark">
<div class=" container ">
  <div class="  card    ">
  
  <h2><?php echo $name;?></h2>
  
  <p><?php echo $mobile;?></p>
  <p><?php echo $email;?></p>
  
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