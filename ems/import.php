
<?php 
include 'adminheader.php';
	$con=mysqli_connect('localhost','root','','ems');
       $sql="SELECT * FROM preference";
		$res=mysqli_query($con,$sql);
		$row3=mysqli_fetch_array($res);
		
		
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
			
			$sql1="SELECT * FROM course";
			$res1=mysqli_query($con,$sql1);
			$row1=mysqli_fetch_array($res1);
			$cname=$row1['Cname'];	
			
			
			
			$sql3="SELECT * FROM allocated1";
			$res3=mysqli_query($con,$sql3);
			$row3=mysqli_fetch_array($res3);
			$sid=$row3['SID'];
			$cid=$row3['CID'];
			
			$sql2="SELECT * FROM main WHERE Role='student' and ID='$sid'";
			$res2=mysqli_query($con,$sql2);
			$row2=mysqli_fetch_array($res2);
			$name=$row2['Name'];	
			
			
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
	
					
?>

<div class="well">
	
		<!-- Display status message -->
	<?php if(!empty($statusMsg)){ ?>
	<div class="col-xs-12">
		<div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
	</div>
	<?php } ?>
	
	<div class="row">
		<div class="col-md-12" >
			<form action="db.php" method="post">
				<input type="submit" class="btn btn-primary" name="callpy" value="Allocate">
			</form>
	</div>
		<!-- Import link -->
		<div class="col-md-12 head">
			<div class="float-right">
				<a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
			</div>
		</div>
		<!-- CSV file upload form -->
		<div class="col-md-12" id="importFrm" style="display: none;">
			<form action="db.php" method="post" enctype="multipart/form-data">
				<input type="file" name="file" />
				<input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
			</form>
		</div>
	</div>
	    <!-- Data list table --> 
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Student ID</th>
				<th>Student Name</th>
                <th>Course ID</th>
                
            </tr>
        </thead>
        <tbody>
        <?php
        // Get member rows
        $result = $con->query("SELECT * FROM allocated1");
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
        ?>
            <tr>
				<td><?php echo $row['SID']; ?></td>
                <td><?php 
				//$sql3="SELECT * FROM allocated1";
				//$res3=mysqli_query($con,$sql3);
				//$row3=mysqli_fetch_array($res3);
				//$sid=$row3['SID'];
				//$cid=$row3['CID'];
				$sid = $row['SID'];
				$sql2="SELECT * FROM main WHERE Role='student' and ID='$sid'";
				$res2=mysqli_query($con,$sql2);
				$row2=mysqli_fetch_array($res2);
				$name=$row2['Name'];	
				
					echo $name; ?></td>
                <td><?php 
				$sql1="SELECT * FROM course";
				$res1=mysqli_query($con,$sql1);
				//$row1=mysqli_fetch_array($res1);
				//$cname=$row1['Cname'];	
				//$cname="cc";
				if($row['CID']==1)
				{
					$count = 1;
					
					foreach($res1 as $row1)
					{
						
							$cname=$row1['Cname'];
							echo $cname;
							break;
							
					}
				}
				echo $row['CID']; ?></td>
				
                
            </tr>
        <?php } }else{ ?>
            <tr><td colspan="5">No member(s) found...</td></tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<!-- Show/hide CSV upload form -->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
            <!-- /.row -->
</div>
        <!-- /.container-fluid -->
    </div>