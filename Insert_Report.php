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
require "mailer.php";

$obj = new PetientData();
if (isset($_POST["btnsubmit"])) {

    $id = $_POST['txtid'];
    $name = $_POST['txtname'];
    $age = $_POST['txtage'];
    $weight = $_POST['txtweight'];
    $gender = $_POST['gender'];
    $addr = $_POST['txtaddr'];
    $cno = $_POST['txtcno'];
    $med = $_POST['txtmed'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $report = "";
    if (isset($_FILES['reportfile'])) {
        $report = "reports/" . $name . "_report.pdf";
        move_uploaded_file($_FILES['reportfile']['tmp_name'], "reports/" . $name . "_report.pdf");
    }
    $cnt = $obj->insertData($id, $name, $age, $weight, $gender, $addr, $cno, $med, $date,$time,$report);

    if ($cnt > 0) {

        ?>
        <div class="alert alert-success" role="alert">
            Data inserted Successfully
        </div>
        <?php
         $obj->mailSender($id,$name, $age, $weight, $gender, $addr, $cno, $med, $date,$time,$report);
         $obj->mailAdmin($name);
        header("location:index.php");
        exit();

    } else {

        ?>
        <div class="alert alert-danger" role="alert">
            Something Went Wrong!!! Not Inserted
        </div>
    <?php
    }
   


}
?>
<!-- HTML form Starts Here -->

<?php require "includes/header.php"; ?>
<div class="container">
    <form method="POST" action="Insert_Report.php" class="form-inline" id="user_form" enctype="multipart/form-data">
        <div class="form-group mx-sm-5 mb-2">
            <label for="id" class="sr-only">ID</label>
            <input name="txtid" type="text" class="form-control" id="id" value="<?php echo $_SESSION['id']; ?>"
                readonly>
        </div>
        <div class="form-group mx-sm-5 mb-2">
            <label for="name" class="sr-only">Name</label>
            <input name="txtname" type="text" class="form-control" id="name" placeholder="Enter Your Name" required>
        </div>

        <div class="form-group mx-sm-5 mb-2">
            <label for="age" class="sr-only">Age</label>
            <input name="txtage" type="text" class="form-control" id="age" placeholder="Enter Age" require>
        </div>

        <div class="form-group mx-sm-5 mb-2">
            <label for="weight" class="sr-only">Weight</label>
            <input name="txtweight" type="text" class="form-control" id="weight" placeholder="enter Weight" required>
        </div>

        <div class="form-group mx-sm-5 mb-2">
            <label for="gender" class="sr-only">Select Gender </label>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="radio1" name="gender" value="male" checked>Male
                <label class="form-check-label" for="radio1"></label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="radio2" name="gender" value="female">Female
                <label class="form-check-label" for="radio2"></label>
            </div>

        </div>

        <div class="form-group mx-sm-5 mb-2">
            <label for="addr" class="sr-only">Address</label>
            <textarea name="txtaddr" id="addr" rows='3' cols='25' class="form-control"></textarea>
        </div>

        <div class="form-group mx-sm-5 mb-2">
            <label for="cno" class="sr-only">Contect No</label>
            <input name="txtcno" type="text" class="form-control" id="cno" placeholder="enter Contect Number">
        </div>

        <div class="form-group mx-sm-5 mb-2">
            <label for="med" class="sr-only">Medicine</label>
            <input name="txtmed" type="text" class="form-control" id="med"
                placeholder="Enter Medicine if any you are taking">
        </div>

        <div class="form-group mx-sm-5 mb-2">
            <label for="report" class="sr-only">Report</label>
            <input name="reportfile" type="file" class="form-control" id="report">
        </div>

        <div class="form-group mx-sm-5 mb-2">
            <label for="date" class="sr-only">Select Date</label>
            <input name="date" type="date" class="form-control" id="date">
        </div>

        <!-- <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                ---Choose Time---
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <option value="5-6">5 to 6</option>
                <option value="6-7">6 to 7</option>
                <option value="7-8">7 to 8</option>
                <option value="8-9">8 to 9</option>
                <option value="9-10">9 to 10</option>
            </div>
        </div> -->

        <!-- <div class="dropdown" style="margin-left: 48px;">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                ---Choose Time---
            </button> -->
            <select class="bg-secondary text-light border rounded" style="margin-left: 48px; padding: 10px;" name="time">
                <option value="" >---Choose Time---</option>
                <option value="5PM-6PM" >5PM to 6PM</option>
                <option value="6PM-7PM" >6PM to 7PM</option>
                <option value="7PM-8PM" >7PM to 8PM</option>
                <option value="8PM-9PM" >8PM to 9PM</option>
                <option value="9PM-10PM" >9PM to 10PM</option>
            </select>
        <!-- </div> -->

        <div class="form-group mx-auto text-center"> <!-- Add mx-auto and text-center classes to center-align -->
            <input type="submit" name="btnsubmit" class="btn btn-primary" value="Request For Appointment" />
        </div>

    </form>

    <?php require "includes/footer.php"; ?>
</div>