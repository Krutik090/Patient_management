<?php require "header.php";
require "../config.php";

$obj = new PetientData();
if (!isset($_SESSION['admin'])) {
  header("location:adminlogin.php");
} 
?>
<h1 class="h3 mt-3 fw-normal center"> History </h1>
<?php
$rows = $obj->selectStatusData(-1);
if (count($rows) > 0) {
  ?>
  <div class="container">
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
          <th>Contect No</th>
          <th>Medicine</th>
          <th>Reports</th>
          <th>Time Slot</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php

        foreach ($rows as $row):
          if ($row->pstatus == -1) { ?>
            <tr>

              <td><?php echo $row->pid; ?></td>
              <td><?php echo $row->pname; ?></td>
              <td><?php echo $row->reference; ?></td>
              <td><?php echo $row->age; ?></td>
              <td><?php echo $row->pweight; ?></td>
              <td><?php echo $row->gender; ?></td>
              <td><?php echo $row->addr; ?></td>
              <td><?php echo $row->cno; ?></td>
              <td><?php echo $row->medicine; ?></td>
              <td><a href="<?php echo "../".$row->report; ?>" ><?php echo $row->report; ?></a></td>
              <td><?php echo $row->pdate . ":" . $row->ptime; ?></td>
              <td><?php echo $obj->checkStatus(-1); ?></td>

            </tr>
          <?php }endforeach;
} else { ?>
        <table class="table">
          <td> No Records Yet </td>
        </table>
      <?php } ?>



    </tbody>
  </table>
</div>