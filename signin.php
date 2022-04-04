<?php include "connection.php" ?>
<?php session_start(); ?>
<?php global $message; ?>
<?php
    if(isset($_SESSION['id'])){
       header("Location: home.php");
   }
    if(isset($_SESSION['tid'])){
           header("Location: teacher_home.php");
       }
?>
<?php
    if(isset($_POST['login'])){
    $id         = $_POST['id'];
    $password   = $_POST['password'];    
    if(isset($_POST['admin'])){
            $query = "SELECT * FROM teacher WHERE id = '{$id}';";

            $select_user_query = mysqli_query($connection, $query);
            if(!$select_user_query){
            die("QUERY Failed "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
            }

            while($row = mysqli_fetch_array($select_user_query)){
            $db_id          = $row['id'];
            $db_name        = $row['name'];
            $db_password    = $row['password'];
            $db_department  = $row['department'];
            $db_role        = $row['role'];
            }
            if($db_id == $id && $db_password == $password){
            $_SESSION['tid']         = $db_id;
            $_SESSION['tname']       = $db_name;
            $_SESSION['tdepartment'] = $db_department;
            $_SESSION['trole']       = $db_role;
            header("Location: teacher_home.php");
            } else {
            $message = "Invalid teacher Id or Password";
            header("Location: signin.php");
            }
        } else{
            
        $query = "SELECT * FROM user WHERE id = '{$id}';";

        $select_user_query = mysqli_query($connection, $query);
        if(!$select_user_query){
            die("QUERY Failed "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
        }

        while($row = mysqli_fetch_array($select_user_query)){
            $db_id          = $row['id'];
            $db_name        = $row['name'];
            $db_password    = $row['password'];
            $db_regno       = $row['regno'];
            $db_department  = $row['department'];
            $db_series      = $row['series'];
            $db_term        = $row['term'];
            $db_sem         = $row['sem'];
        }
        if($db_id == $id && $db_password == $password){
            $_SESSION['id']         = $db_id;
            $_SESSION['name']       = $db_name;
            $_SESSION['regno']      = $db_regno;
            $_SESSION['department'] = $db_department;
            $_SESSION['series']     = $db_series;
            $_SESSION['term']       = $db_term;
            $_SESSION['sem']        = $db_sem;
            header("Location: home.php");

        } else {
            $message = "Invalid User Id or Password";
            header("Location: signin.php");
        }
            
    }    
}else
        $message = "";
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign In</title>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
   <div class="wrapper" style="margin-bottom: -80px; min-height:100%">
       <div class="row">
        <div class="col-lg-4 col-md-3 col-sm-1"></div>
        <div class="col-lg-4 col-md-6 col-sm-10" style="padding-top:50px">
            <div style="text-align: center; margin: 15px 0 12px 0;">
                <img src="img/logo.png" alt="Avatar" style="width: 30%; border-radius: 15%">
            </div>
            <div style="text-align: center; color: red;">
                <small><?php echo $message ?></small>
            </div>
            <form action="signin.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                <label for="id"><b>User ID</b></label>
                <input type="text" class="form-control" placeholder="Enter ID" name="id" required>
                </div>

                <div class="form-group">
                <label for="psw"><b>Password</b></label>
                <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                </div>

                <div class="row">
                    <div class="col-7">
                    <button class="btn btn-primary" name="login" type="submit">Login</button>
                    </div>
                    <div class="col-5">
                    <span class="psw"> <a href="recovery.php">Forgot password?</a></span>
                    </div>   
                </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="admin" value="admin" class="custom-control-input" id="customCheck1">
                      <label class="custom-control-label" for="customCheck1">Login as Teacher</label>
                    </div>
            </form>
            <p style="text-align: center;">Don't have account? <a href="signup.php">Sign Up</a></p>
        </div>
       </div>
   </div>
   <?php include "footer.php" ?>
</body>
</html>
    