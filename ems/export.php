
<?php 
include 'adminheader.php';
        $sql="SELECT * FROM preference";
		$res=mysqli_query($con,$sql);
		
		$sql1="SELECT Max FROM course ";
		$res1=mysqli_query($con,$sql1);
		
		
		
					
?>

<div class="well">
	
	<form action="db.php" method="post">
	<input type="submit" class="btn btn-info" name="export_max" value="Export Size">
	<input type="submit" class="btn btn-info" name="export" value="Export">
	<input type="submit" class="btn btn-info" name="import" value="Import">
	</form>
	<h2 class="text-center text-danger">Preference List</h2>
		<form action="db.php" method="post">
		
		 <table class="table table-striped table-hover ">
	  <thead>
		<tr>
		  
		  <th>Student_ID</th>
		  <th>Elective1</th>
		  <th>Elective2 </th>
		  <th>Elective3</th>
		  <th>Elective4</th>
		  <th>Elective5</th>
		  
		</tr>
	  </thead>
	  <tbody>
		<?php
			foreach($res as $row)
			{
				
					$sid=$row['SID'];
					$p1=$row['Elec1'];
					$p2=$row['Elec2'];
					$p3=$row['Elec3'];
					$p4=$row['Elec4'];
					$p5=$row['Elec5'];
					
			?>
			
			
		<tr class="success">
		  
		  <td><?php echo $sid; ?></td>
		  <td><?php echo $p1; ?></td>
		  <td><?php echo $p2; ?></td>
		  <td><?php echo $p3; ?></td>
		  <td><?php echo $p4; ?></td>
		  <td><?php echo $p5; ?></td>
		  
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