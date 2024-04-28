<?php require "includes/header.php"; ?>
<?php require "config.php" ?>

<?php 
$obj = new PetientData();
if(isset($_SESSION['username'])){
  header("location:index.php");
}

  if(isset($_POST['btnsubmit'])){

    if(!empty($_POST['txtemail']) and !empty($_POST['txtusername']) and !empty($_POST['txtpassword1'] and !empty($_POST['txtpassword2']))){
      $email = $_POST['txtemail'];
      $username = $_POST['txtusername'];
      $password = $_POST['txtpassword1'];
      $cpassword = $_POST['txtpassword2'];
      $checkqry = "SELECT * FROM users WHERE email= '$email'";
      $rqry = "INSERT INTO users(email,username,mypassword) VALUES(:email,:username,:mypassword)";
      $obj->register($email,$username,$password,$cpassword,$checkqry,$rqry);
     
    }else{?>
      <div class="alert alert-danger" role="alert">
      Fill All Fields
      </div>
   <?php }
  }

?>
<main class="form-signin w-50 m-auto">
  <form method="POST" action="register.php">
   
    <h1 class="h3 mt-5 fw-normal text-center">Please Register</h1>

    <div class="form-floating">
      <input name="txtemail" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>

    <div class="form-floating">
      <input name="txtusername" type="text" class="form-control" id="floatingInput" placeholder="username">
      <label for="floatingInput">Username</label>
    </div>

    <div class="form-floating">
      <input name="txtpassword1" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floating">
      <input name="txtpassword2" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Confirm Password</label>
    </div>

    <button name="btnsubmit" class="w-100 btn btn-lg btn-primary" type="submit">register</button>
    <h6 class="mt-3">Aleardy have an account?  <a href="login.php">Login</a></h6>

  </form>
</main>
<?php require "includes/footer.php"; ?>
