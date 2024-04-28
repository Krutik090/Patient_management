<?php require "includes/header.php"; ?>
<?php require "config.php" ?>
<?php

$obj = new PetientData();
if(isset($_SESSION['username'])){
  header("location:index.php");
}
// Check if submit button is pressed
  if(isset($_POST['btnsubmit'])){
    //Check if Both filed are filled 
    if(!empty($_POST['txtemail']) and !empty($_POST['txtpassword'])){
      $email = $_POST['txtemail'];
      $password = $_POST['txtpassword'];
      //checks the creadencials with help of login method
      $obj->login($email,$password);
      if($obj){ header("location:index.php"); }
      }
      else{
        ?>
        <div class="alert alert-danger" role="alert">
          Fill Both Fields
        </div> 
     <?php  
      }
    }
    
  

?>
<main class="form-signin w-50 m-auto">
  <form method="POST" action="login.php">
    <!-- <img class="mb-4 text-center" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
    <h1 class="h3 mt-5 fw-normal text-center"> Login </h1>

    <div class="form-floating">
      <input name="txtemail" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input name="txtpassword" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    

    <button class="w-100 btn btn-lg btn-primary" type="submit" name="btnsubmit">Login</button>
    <h6 class="mt-3">Don't have an account  <a href="register.php">Create your account</a></h6>
  </form>
</main>
<?php require "includes/footer.php"; ?>
