
<?php 
include 'adminheader.php';
        $sql="SELECT * FROM preference";
		$res=mysqli_query($con,$sql);
		
		
					
?>

<div class="well">
	
	<form action="db.php" method="post">
	<input type="submit" class="btn btn-info" name="export" value="Export">
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
					$p1=$row['Pref1'];
					$p2=$row['Pref2'];
					$p3=$row['Pref3'];
					$p4=$row['Pref3'];
					$p5=$row['Pref4'];
					
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