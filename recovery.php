<?php include "connection.php" ?>
<?php session_start(); ?>
<?php
    if(isset($_SESSION['id'])){
       header("Location: home.php");
   }
?>
<?php
    $value   = "display: none";
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        
        $query = "SELECT * FROM user WHERE email = '{$email}';";
    
        $email_search_query = mysqli_query($connection, $query);
        if(!$email_search_query){
            die("QUERY Failed "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
        }
    global $db_email;
    global $db_name;
    while($row = mysqli_fetch_array($email_search_query)){
        $db_name        = $row['name'];
        $db_email       = $row['email'];
    }
    if($db_email == $email){
        $to         = $email;
        $_SESSION['email'] = $email;
        $subject    = 'Recovery Code For Your Account';
        $code       = mt_rand(100000,999999);
        
        $query = "UPDATE user SET recovery = '{$code}' WHERE email = '{$email}';";
        $save_code_query = mysqli_query($connection, $query);
        if(!$save_code_query){
        die("QUERY Failed "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
        }
        
        $message    = 'Hi '.$db_name.',<br>Your recovery code is '.$code;
        $headers    = 'From: ruetstudentmanagement@gmail.com' . "\r\n" .
                    'Reply-To: ruetstudentmanagement@gmail.com' . "\r\n" .
                    'MIME-Version: 1.0' . "\r\n" .
                    'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
        if(mail($to, $subject, $message, $headers)){
            $message = "Your recovery code has been sent. Check email.";
            $value   = "display: block";
        }
        else
            echo "Email sending failed";

        
    } else {
        $message = "Email don't exist";
    }
} else
        $message ="";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
   <div class="wrapper" style="padding: 150px 0px 0px 450px">
    <div class="card" style="width: 30rem;">
    <h5 class="card-header">Password Recovery</h5>
    <div class="card-body">
        <form class="form-inline" action="recovery.php" method="post" enctype="multipart/form-data">

      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text">Email</div>
        </div>
        <input name="email" type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="abc@xyz.com">
      </div>

      <button name="submit" type="submit" class="btn btn-primary mb-2" style="margin-left:15px;">Send Code</button>
      <small><?php echo $message ?></small>
    </form>
    <hr>
    <div style="<?php echo $value ?>">
        <form action="changepassword.php" method="post" enctype="multipart/form-data">

          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text">Code</div>
            </div>
            <input name="code" type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Recovery Code" required>
          </div>
          
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text">Password</div>
            </div>
            <input name="password" type="password" class="form-control" id="inlineFormInputGroupUsername2" placeholder="New Password" required>
          </div>

          <button name="change" type="submit" class="btn btn-primary col-12">Change</button>
        </form>
        
    </div>
    
    </div>
    </div>
   </div>
    <script src="js/slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
     
</body>
</html>