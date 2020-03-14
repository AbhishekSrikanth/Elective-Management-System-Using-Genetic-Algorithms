<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="css/bootstrap.css" rel="stylesheet" id="bootstrap-csss">

<script src="js/jquery-3.4.1.min.js"></script>
<link href="css/style.css" rel="stylesheet"> 
<script src="js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<?php include 's.php'; ?>


<?php
	$con=mysqli_connect('localhost','root','','blog1');
	$sql="SELECT * FROM category_details ";
	$res=mysqli_query($con,$sql);
	
	$page1="home";
	if(isset($_GET['page1']))
	{
		$page1=$_GET['page1'];
	}
	else
	{
		if(isset($p))
		{
			$page1=$p;
		}
		else
		{
			$page1="home";
		}
	}
?>







<div id="throbber" style="display:none; min-height:120px;"></div>
<div id="noty-holder"></div>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://cijulenlinea.ucr.ac.cr/dev-users/">
                <img src="http://placehold.it/200x50&text=LOGO" alt="LOGO">
            </a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li><a href="#" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Stats"><i class="fa fa-bar-chart-o"></i>
                </a>
            </li>  
			<?php if(!empty($_SESSION['uid']))
			{?>
				<li >
                <a href="db.php?page=index">My Home</a>
                
				</li>
				<li >
                <a href="db.php?page=profile">My Profile</a>
                
				</li>
				<li >
                <a href="db.php?logout">Log Out </a>
                
				</li>
			<?php
			}				
			else
			{ ?>
			<li >
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#sign">Sign Up </button>
                
            </li>
            <li >
                <a href="login.php">Log In </a>
                
            </li>
			<?php } ?>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav top-nav ">
               
				<li <?php if($page1=='Home') echo 'class="active"';?>><a href="db.php?cid=0&page1=Home"><i class="fa fa-fw"></i>Home</a></li>
                <?php
						foreach($res as $row)
						{
								$c_name=$row['C_Name'];
								$c_id=$row['C_ID'];
								
						?>
				<li <?php if($page1==''.$c_name.'') echo 'class="active"';?>><a href="db.php?cid=<?php echo $c_id ?>&page1=<?php echo ''.$c_name.''; ?>"><i class="fa fa-fw"></i><?php echo $c_name; ?></a></li>
						<?php } ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
	</div>
	