<?php 
include 'adminheader.php';
        $sql="SELECT * FROM feedback_report;";
		$res=mysqli_query($con,$sql);
					
?>

	
<div class="well">
	<h2 class="text-center text-danger">All Feedback Reports</h2>
		<form action="db.php" method="post">
				
				
				 <table class="table table-striped table-hover ">
			  <thead>
				<tr>
				  
				  <th>Feedback ID</th>
				  <th>Feedback Report</th>
				  <th>Date</th>
				</tr>
			  </thead>
			  <tbody>	
				<?php
					foreach($res as $row)
					{
						
							$f_id=$row['F_ID'];
							$fb_report=$row['Feedback'];
							$date=$row['Date'];
							
					?>
				<tr class="success">
				  
				  <td><?php echo $f_id; ?></td>
				  <td><?php echo $fb_report; ?></td>
				  <td><?php echo $date; ?></td>
				  
				</tr>
					<?php } ?>
				</tbody>
				</table> 
		</form>
</div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>