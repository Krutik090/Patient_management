<?php require "includes/header.php"; ?>
<?php require "config.php" ?>


<?php
$obj = new PetientData();
if (!isset($_SESSION['username'])) {
	header("location:login.php");
} else {
	$pid = $_SESSION['id'];
}
$rows = $obj->selectAll($pid);
?>
<div class="container">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>PetientID</th>
					<th>Name</th>
					<th>Reference</th>
					<th>Age</th>
					<th>Weight</th>
					<th>Gender</th>
					<th>Address</th>
					<th>Contact No</th>
					<th>Medicine</th>
					<th>Reports</th>
					<th>Time Slot</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php

				foreach ($rows as $row):if($row->pstatus!=-1){?>
					<tr>

						<td><?php echo $row->pid; ?></td>
						<td><?php echo $row->pname; ?></td>
						<td><?php echo $row->reference ?></td>
						<td><?php echo $row->age; ?></td>
						<td><?php echo $row->pweight; ?></td>
						<td><?php echo $row->gender; ?></td>
						<td><?php echo $row->addr; ?></td>
						<td><?php echo $row->cno; ?></td>
						<td><?php echo $row->medicine; ?></td>
						<td><a href="<?php echo $row->report; ?>" ><?php echo $row->report; ?></a></td>
						<td><?php echo $row->pdate . ":" . $row->ptime; ?></td>
						<td> <?php echo $obj->checkStatus($row->pstatus) ?> </td>

					</tr>
				<?php } endforeach; ?>


			</tbody>
		</table>
	</div>
</div>
	<?php require "includes/footer.php"; ?>