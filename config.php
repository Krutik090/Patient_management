<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'mailer/src/Exception.php';
require 'mailer/src/PHPMailer.php';
require 'mailer/src/SMTP.php';
class PetientData{
    //Hostname
    public $host = "localhost";

    //Database name
    public $dbname = "Petientdb";

    //Username
    public $user = "root";

    //password
    public $pass = "";

    public $conn;

    //Contructor Make Connection to the Database
    function __construct(){
        //PHP Database connection Object (PDO)
    try{
        // $conn = new PDO("mysql:host=$host;dbname = $dbname;",$user,$pass);
         $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;", $this->user, $this->pass);
         $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
         }
         catch(PDOException $e){
             echo "Error :" . $e->getMessage();
         }

    }


    function insertData($pid,$pname,$ref,$age,$pweight,$gender,$addr,$cno,$medicine,$date,$time,$Report){
        $insert = $this->conn->prepare("INSERT INTO petient_data (pid,pname,reference,age,pweight,gender,addr,cno,medicine,pdate,ptime,Report) VALUES (:pid,:pname,:reference,:age,:pweight,:gender,:addr,:cno,:med,:pdate,:ptime,:report)");

        $cnt = $insert->execute([
         ':pid'=>$pid,
         ':pname'=>$pname,
         ':reference'=>$ref,
         ':age'=>$age,
         ':pweight'=>$pweight,
         ':gender'=>$gender,
         ':addr'=>$addr,
         ':cno'=>$cno,
         ':med'=>$medicine,
         ':pdate'=>$date,
         ':ptime'=>$time,
         ':report'=>$Report
      ]);

      return $cnt;
    }

    //Update data with Report file
    function updateDataReport($rid,$pname,$ref,$age,$pweight,$gender,$addr,$cno,$medicine,$date,$Report,$time){
        
        $sql = "UPDATE petient_data 
      SET pname = :pname, 
          reference = :reference,  
          age = :age, 
          pweight = :pweight, 
          gender = :gender, 
          addr = :addr, 
          cno = :cno, 
          medicine = :medicine, 
          pdate = :pdate,
          ptime = :ptime,
          report = :report
      WHERE rid = :rid";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':pname', $pname, PDO::PARAM_STR);
        $stmt->bindParam(':reference',$ref, PDO::PARAM_STR);
        $stmt->bindParam(':rid', $rid, PDO::PARAM_INT);
        $stmt->bindParam(':pweight', $pweight, PDO::PARAM_INT);
        $stmt->bindParam(':age', $age, PDO::PARAM_INT);
        $stmt->bindParam(':addr', $addr, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
        $stmt->bindParam(':medicine', $medicine, PDO::PARAM_STR);
        $stmt->bindParam(':cno', $cno, PDO::PARAM_STR);
        $stmt->bindParam(':pdate', $date, PDO::PARAM_STR);
        $stmt->bindParam(':ptime',$time,PDO::PARAM_STR);
        $stmt->bindParam(':report',$Report,PDO::PARAM_STR);

        
        $stmt->execute();
        return $stmt->rowCount();
        
    }
    // Update Data without Report File
    function updateData($rid,$pname,$ref,$age,$pweight,$gender,$addr,$cno,$medicine,$date,$time){

      $sql = "UPDATE petient_data 
      SET pname = :pname,
          reference=:reference,  
          age = :age, 
          pweight = :pweight, 
          gender = :gender, 
          addr = :addr, 
          cno = :cno, 
          medicine = :medicine, 
          pdate = :pdate,
          ptime = :ptime
      WHERE rid = :rid";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':pname', $pname, PDO::PARAM_STR);
        $stmt->bindParam(':reference',$ref, PDO::PARAM_STR);
        $stmt->bindParam(':rid', $rid, PDO::PARAM_INT);
        $stmt->bindParam(':pweight', $pweight, PDO::PARAM_INT);
        $stmt->bindParam(':age', $age, PDO::PARAM_INT);
        $stmt->bindParam(':addr', $addr, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
        $stmt->bindParam(':medicine', $medicine, PDO::PARAM_STR);
        $stmt->bindParam(':pdate', $date, PDO::PARAM_STR);
        $stmt->bindParam(':ptime',$time,PDO::PARAM_STR);
        $stmt->bindParam(':cno', $cno, PDO::PARAM_STR);

        
        $stmt->execute();
        return $stmt->rowCount();
        }
    function deleteData($rid){
        
        $delete = $this->conn->prepare("DELETE FROM petient_data WHERE rid=:rid");

  	$delete->execute([':rid' => $rid]);

  	header("location: index.php");
     
    }
    

    function selectAll($pid){
        $data = $this->conn->query("SELECT * FROM petient_data WHERE pid = '$pid'");
        $data->execute();
        $srows = $data->fetchAll(PDO::FETCH_OBJ);
        return $srows;
    }

    function search($rid){
        $data = $this->conn->query("SELECT * FROM petient_data WHERE rid = '$rid'");

        $urows = $data->fetch(PDO::FETCH_OBJ);
        return $urows;
    }

    function login($email,$password){
        $login = $this->conn->query("SELECT * FROM users WHERE email= '$email'");
        $login->execute();

        $data = $login->fetch(PDO::FETCH_ASSOC);
        if($login->rowCount()>0){

        if(password_verify($password,$data['mypassword'])){
            $_SESSION['username'] = $data['username'];
            $_SESSION['id'] = $data['id'];
          
            return true;

            }else{ ?>
                <div class="alert alert-danger" role="alert">
                    Email or Password Incorrect
                </div>
            <?php }
        }else{?>
                <div class="alert alert-danger" role="alert">
                   Don't Have Any Account With Email, Register First!!!
                </div>
       <?php }

    }

    
//Create an instance; passing `true` enables exceptions 
function mailSender($pid,$name,$ref ,$age, $weight, $gender, $addr, $cno, $med, $date,$time,$report){

    $qry = $this->conn->query("SELECT * FROM users WHERE id= '$pid'");
        $qry->execute();

        $data = $qry->fetch(PDO::FETCH_ASSOC);
        if($qry->rowCount()>0){
            $user = $data['username'];
            $reciver = $data['email'];
        }else{
            echo "Something Went Wrong";
        }

    $mail = new PHPMailer(true);
try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'krutikthakar2539@gmail.com';                     //SMTP username
    $mail->Password   = 'gnuqoldnqdfceiqj';                               //SMTP password
   // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('krutikthakar2539@gmail.com', 'Mailer');
    $mail->addAddress($reciver, $user);     //Add a recipient
    //$mail->addAddress($reciver);               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment($report);         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Request for apointment';
    $mail->Body    = 'Your Request for appointment is successfully send,Doctor will reach to you soon.<br> Here\'s your details
    <br>Name : '.$name.'
    <br>Age : '.$age.'
    <br>Weight : '.$weight.'
    <br>Gender : '.$gender.'
    <br>Address : '.$addr.'
    <br>Contect No : '.$cno.'
    <br>Medicine : '.$med.'
    <br>Date : '.$date.'
    <br>Time : '.$time.'
    ';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    //echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

function mailAdmin($name){
/*
    $qry = $this->conn->query("SELECT * FROM users WHERE id= '$pid'");
        $qry->execute();

        $data = $qry->fetch(PDO::FETCH_ASSOC);
        if($qry->rowCount()>0){
            $user = $data['username'];
            $reciver = $data['email'];
        }else{
            echo "Something Went Wrong";
        }
        */

    $mail = new PHPMailer(true);
try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'krutikthakar2539@gmail.com';                     //SMTP username
    $mail->Password   = 'gnuqoldnqdfceiqj';                               //SMTP password
   // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('krutikthakar2539@gmail.com', 'Mailer');
    $mail->addAddress('krutikthakar2539@gmail.com','Admin' );     //Add a recipient
    //$mail->addAddress($reciver);               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment($report);         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Request for apointment';
    $mail->Body    = 'You Have request for appointment from the user: '.$name;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    //echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}


    
    function register($email,$username,$password,$cpassword,$checkqry,$rqry){
        $login = $this->conn->query($checkqry);
        $login->execute();
        
        if($login->rowCount()>0){?>
                <div class="alert alert-danger" role="alert">
                   Email has Already Registered, Try Another Email!!!
                </div>
        <?php }else{
            if($password == $cpassword){
          $insert = $this->conn->prepare($rqry);
  
          $insert->execute([
            ':email' => $email,
            ':username' =>$username,
            ':mypassword' => password_hash($password,PASSWORD_DEFAULT),
          ]);
          header("location:login.php");
        }else{ ?>
                <div class="alert alert-danger" role="alert">
                   Password Must be same!!!
                </div>

        <?php
        }
    }
}

function adminRegister($email,$username,$password,$cpassword,$checkqry,$rqry){
    $login = $this->conn->query($checkqry);
    $login->execute();
    
    if($login->rowCount()>0){?>
            <div class="alert alert-danger" role="alert">
               Email has Already Registered, Try Another Email!!!
            </div>
    <?php }else{
        if($password == $cpassword){
      $insert = $this->conn->prepare($rqry);

      $insert->execute([
        ':email' => $email,
        ':username' =>$username,
        ':mypassword' => password_hash($password,PASSWORD_DEFAULT),
      ]);
      header("location:adminlogin.php");
    }else{ ?>
            <div class="alert alert-danger" role="alert">
               Password Must be same!!!
            </div>

    <?php
    }
}
}
    function adminLogin($email,$password){
        $login = $this->conn->query("SELECT * FROM tbladmin WHERE uemail='$email'");
        $login->execute();

        $data = $login->fetch(PDO::FETCH_ASSOC);
        if($login->rowCount()>0){

        if(password_verify($password,$data['mypassword'])){
            
            $_SESSION['admin'] = $data['username'];
            header("location:admincontrol.php");
            
            

            }else{ ?>
                <div class="alert alert-danger" role="alert">
                    Email or Password Incorrect
                </div>
            <?php }
        }else{?>
                <div class="alert alert-danger" role="alert">
                   Don't Have Any Account With Email, Register First!!!
                </div>
       <?php }

    }

    function selectStatusData($statusid){
        $data = $this->conn->query("SELECT * FROM petient_data WHERE pstatus = $statusid");
        $data->execute();
        $srows = $data->fetchAll(PDO::FETCH_OBJ);
        return $srows;

    }

    function checkStatus($pstatus){
        if($pstatus == 0){
            return "Pending";
        }
        else if ($pstatus == 1){
            return "Approved";
        }
        else if($pstatus == -1){
            return "Completed";
        }
    }

    function updateStatus($rid,$statusid){
        $sql= "UPDATE petient_data SET pstatus=:pstatus WHERE rid=:rid";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":pstatus",$statusid,PDO::PARAM_INT);
        $stmt->bindParam(":rid",$rid,PDO::PARAM_INT);
        $stmt->execute();
        header("location: admincontrol.php");
        
    }

}


?>
<script>
    function confirmDelete(rid){
        var response = confirm("Are you sure you want to delete this item?");
        if(response == true){
            window.location = "delete.php?del_id="+ rid ;
        }else{
            window.location = "edit.php";
        }
    }
    function confirmApprove(rid,sid){
        if(confirm("Are you sure you want to Approve?")){
            alert("Approved!");
                window.location = "updateStatus.php?r_id="+rid+"&s_id="+sid;
        }else{
            window.location = "admincontrol.php";
            }
    }    
</script>



 
