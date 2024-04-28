<?php require "header.php"; 
      require "../config.php";

 $obj = new PetientData(); 
     if(!isset($_SESSION['admin'])){
     header("location:adminlogin.php");
     }
     ?>
<div class="container">
          

            <h1 class="h3 mt-3 fw-normal"> Approved Requestes </h1> 
          <?php
          $arows = $obj->selectStatusData(1);
          if(count($arows)>0){ ?>
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
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                       <?php
                      
                     foreach($arows as $row):if($row->pstatus==1){ ?>   
                    <tr>
                   
                     <td><?php echo $row->pid; ?></td>
                     <td><?php echo $row->pname; ?></td>
                     <td><?php echo $row->age; ?></td>
                     <td><?php echo $row->pweight; ?></td>
                     <td><?php echo $row->gender; ?></td>
                     <td><?php echo $row->addr; ?></td>
                     <td><?php echo $row->cno; ?></td>
                     <td><?php echo $row->medicine; ?></td>
                     <td><a href= "<?php echo "../".$row->report; ?>" ><?php echo $row->report; ?></a></td>
                     <td><?php echo $row->pdate.":".$row->ptime; ?></td>
                     <td><a class="btn btn-primary" onclick="confirmApprove(<?php echo $row->rid;?>,-1)">Completed</a></td>
                        
                    </tr>
                <?php } endforeach;    

              }else{ ?>
                <table class="table">
              <td> No Pending Requestes</td>
              </table>

            <?php   } ?>
              
             

               </tbody>
             </table>
      </div>
     