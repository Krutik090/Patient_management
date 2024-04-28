<?php require "includes/header.php"; ?>
<?php require "config.php"?>


<?php
$obj = new PetientData(); 
	if(!isset($_SESSION['username'])){
    header("location:login.php");
	}
	else{
		$pid = $_SESSION['id'];
	}
    $rows = $obj->selectAll($pid);
	if(count($rows)>0){
?>
	<div class="container"> 
		<table class="table">
		  <thead>
		    <tr>
		      <th>PetientID</th>
		      <th>Name</th>
		      <th>Age</th>
		      <th>Weight</th>
              <th>Gender</th>
              <th>Address</th>
              <th>Contect No</th>
              <th>Medicine</th>
              <th>Reports</th>
			  <th>Time Slot</th>
			  <th>Status</th>
			  <th></th>
			  <th></th>
		    </tr>
		  </thead>
		  <tbody>
		  	 <?php
			  
			 foreach($rows as $row): if($row->pstatus!=-1){ ?>   
		    <tr>
		   
		     <td><?php echo $row->pid; ?></td>
		     <td><?php echo $row->pname; ?></td>
             <td><?php echo $row->age; ?></td>
             <td><?php echo $row->pweight; ?></td>
             <td><?php echo $row->gender; ?></td>
             <td><?php echo $row->addr; ?></td>
             <td><?php echo $row->cno; ?></td>
             <td><?php echo $row->medicine; ?></td>
             <td><a href="<?php echo $row->report; ?>"><?php echo $row->report; ?></a></td>
			 <td><?php echo $row->pdate.":".$row->ptime; ?></td>
			 <td> <?php echo $obj->checkStatus($row->pstatus) ?> </td>
		     <td><a class="btn btn-danger" onclick="confirmDelete(<?php echo $row->rid; ?>)">delete</a></td>
			 <td><a href="update.php?upd_id=<?php echo $row->rid; ?>" class="btn btn-warning">update</a></td>
		    </tr>
		<?php } endforeach; ?>


		  </tbody>
		</table>
	</div>
	<?php  } else{  ?>

		<table class="table">
		<td> No Record Inserted Yet!!!</td>
		</table>

	<?php } ?>
<?php require "includes/footer.php"; ?>
