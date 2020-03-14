<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="css/bootstrap.css" rel="stylesheet" id="bootstrap-csss">
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/jquery-3.2.1.js"></script>
<script src="js/bootstrap.min.js"></script>

<link href="css/style.css" rel="stylesheet"> 
<!------ Include the above in your HEAD tag ---------->

<script>
	function selectAll(source)
	{
		checkboxes = document.getElementsByName('check[]');
		for(var i in checkboxes)
		checkboxes[i].checked = source.checked;
	}
</script>




<div id="throbber" style="display:none; min-height:120px;"></div>
<div id="noty-holder"></div>
<div id="wrapper" class="bg-dark ">
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
            <li class="dropdown">
                <a href="db.php?logout">Logout </a>
                
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav pull-left">
                <li><a href="#"><i class="fa fa-fw fa-dashboard"></i> ADMIN DASHBOARD<i class=" pull-right"></i></a></li>
                <!--<li><a href="db.php?page=index"><i class="fa fa-fw fa-home"></i>Home<i class="pull-right"></i></a></li>-->
                <li><a href="db.php?page=profile"><i class="fa fa-fw fa-user"></i>My Profile</a></li>
				<li><a href="db.php?page=feedbackreport"><i class="fa fa-fw fa-paper-plane-o"></i>Feedback Report</a></li>
				<li><a href="db.php?page=export"><i class="fa fa-fw fa-paper-plane-o"></i>Export</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    