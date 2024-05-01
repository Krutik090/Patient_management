<style>
form {
	margin-top: 50px;
    margin-left: 50px;
    margin-right: 50px;
    margin-bottom: 50px;
}
</style>



<?php

require "config.php";
$obj = new PetientData();

// Getting the Update ID from the Get Method from URL 
if(isset($_GET["upd_id"])) {

    $rid = $_GET["upd_id"];
    // Calling Search Method for retirving the data which is belongs to the Update ID 
    // furthur we can fill that data in the form so user can update it
    $rows=$obj->search($rid);
    $name = $rows->pname;
    $ref = $rows->reference;
    $age = $rows->age;
    $weight=$rows->pweight;
    $gender = $rows->gender;
    $addr=$rows->addr;
    $cno=$rows->cno;
    $report=$rows->report;
    $date=$rows->pdate;
    $time=$rows->ptime;
    $medicine=$rows->medicine;;
    

// cheking if Update button is clicked or not
if(isset($_POST['btnupdate'])){
        $name = $_POST['txtname'];
        $ref = $_POST['txtref'];
        $age = $_POST['txtage'];
        $weight = $_POST['txtweight'];
        $gender = $_POST['gender'];
        $addr = $_POST['txtaddr'];
        $cno = $_POST['txtcno'];
        $med = $_POST['txtmed'];
        $date =$_POST['date'];
        $time =$_POST['time'];
        $report = "";
          
        // if file is seleted for update then we will call method which updates the report
        if(isset($_FILES['reportfile'])){
           $report = "reports/".$name."_report.pdf";
           move_uploaded_file($_FILES['reportfile']['tmp_name'],"reports/".$name."_report.pdf");
           $cnt = $obj->updateDataReport($rid,$name,$ref,$age,$weight,$gender,$addr,$cno,$med,$date,$report,$time);
        }else{
            // Otherwise call method without UPDATE Reports
            $cnt = $obj->updateData($rid,$name,$ref,$age,$weight,$gender,$addr,$cno,$med,$date,$time);
    
        }
      
       if($cnt>0){
        
     ?>
        <div class="alert alert-success" role="alert">
           Data Updated Successfully
        </div>
     <?php
     header("location:index.php");
     exit();
      
       }else{
        
     ?>
        <div class="alert alert-danger" role="alert">
           Something Went Wrong!!! Not Updated
        </div>
     <?php   
       }
    
       
    
    }

?>

<!-- HTML form Starts Here -->

<?php require "includes/header.php"; ?>
<div class="container">
	<form method="POST" action="update.php?upd_id=<?php echo $rid; ?>" class="form-inline" id="user_form" enctype="multipart/form-data">
		
		<div class="form-group mx-sm-5 mb-2">
		    <label for="name" class="sr-only">Name</label>
		    <input name="txtname" type="text" class="form-control" id="name" value="<?php echo $name; ?>">
		</div>

        <div class="form-group mx-sm-5 mb-2">
		    <label for="ref" class="sr-only">Reference</label>
		    <input name="txtref" type="text" class="form-control" id="ref" value="<?php echo $ref; ?>">
		</div>

        <div class="form-group mx-sm-5 mb-2">
		    <label for="age" class="sr-only">Age</label>
		    <input name="txtage" type="text" class="form-control" id="age" value="<?php echo $age; ?>">
		</div>  

        <div class="form-group mx-sm-5 mb-2">
		    <label for="weight" class="sr-only">Weight</label>
		    <input name="txtweight" type="text" class="form-control" id="weight" value="<?php echo $weight; ?>">
		</div>

        <div class="form-group mx-sm-5 mb-2">
		    <label for="gender" class="sr-only">Select Gender </label>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="gender" name="gender" value="male" 
                <?php if($gender=="male") echo "checked"; ?> >Male
                <label class="form-check-label" for="radio1"></label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="gender" name="gender" value="female" 
                <?php if($gender=="female") echo "checked"; ?> >Female
                <label class="form-check-label" for="radio2"></label>
            </div>
           
		</div>

        <div class="form-group mx-sm-5 mb-2">
		    <label for="addr" class="sr-only">Address</label>
		    <textarea name="txtaddr" rows='3' cols='25' id="addr" class="form-control"><?php echo $addr; ?>
            </textarea>
		</div>

        <div class="form-group mx-sm-5 mb-2">
		    <label for="cno" class="sr-only">Contect No</label>
		    <input name="txtcno" type="text" class="form-control" id="cno" value="<?php echo $cno; ?>">
		</div>

        <div class="form-group mx-sm-5 mb-2">
		    <label for="med" class="sr-only">Medicine</label>
		    <input name="txtmed" type="text" class="form-control" id="med" value="<?php echo $medicine; ?>">
		</div>

        <div class="form-group mx-sm-5 mb-2">
		    <label for="report" class="sr-only">Report</label>
		    <input name="reportfile" type="file" class="form-control" id="report" value="<?php echo $report; ?>">
		</div>

        <div class="form-group mx-sm-5 mb-2">
		    <label for="date" class="sr-only">Select Date</label>
		    <input name="date" type="date" class="form-control" id="date" value="<?php echo $date; ?>" >
		</div>

        <div>
        <select class="bg-secondary text-light border rounded" style="margin-left: 48px; padding: 10px;" name="time" >
                <option value="" >---Choose Time---</option>
                <option value="5PM-6PM" <?php if($time=="5PM-6PM") echo "selected"; ?>>5PM to 6PM</option>
                <option value="6PM-7PM" <?php if($time=="6PM-7PM") echo "selected"; ?>>6PM to 7PM</option>
                <option value="7PM-8PM" <?php if($time=="7PM-8PM") echo "selected"; ?>>7PM to 8PM</option>
                <option value="8PM-9PM" <?php if($time=="8PM-9PM") echo "selected"; ?>>8PM to 9PM</option>
                <option value="9PM-10PM" <?php if($time=="9PM-10PM") echo "selected"; ?>>9PM to 10PM</option>
            </select>
            </div>
        </div>
		   
        <div class="form-group mx-auto text-center"> <!-- Add mx-auto and text-center classes to center-align -->
            <input type="submit" name="btnupdate" class="btn btn-primary" value="Update" />
        </div>

	</form>
<?php require "includes/footer.php";
} ?>
