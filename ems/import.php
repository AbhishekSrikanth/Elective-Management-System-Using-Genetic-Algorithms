
<?php 
include 'adminheader.php';
	$con=mysqli_connect('localhost','root','','ems');
       $sql="SELECT * FROM preference";
		$res=mysqli_query($con,$sql);
		
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
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
                <td><?php echo $row['CID']; ?></td>
                
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