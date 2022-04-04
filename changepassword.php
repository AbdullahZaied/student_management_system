<?php include "connection.php" ?>
<?php session_start(); ?>
<?php
   if(isset($_SESSION['id'])){
       header("Location: home.php");
   }
?>

<?php

if(isset($_POST['change'])){
    $code     = $_POST['code'];
    $password = $_POST['password'];
    
    $query = "UPDATE user SET password = '{$password}' WHERE email = '{$_SESSION['email']}' AND recovery = '{$code}'";
    $password_change_query = mysqli_query($connection, $query);
    
    if(!$password_change_query){
        die("QUERY Failed ".mysqli_error($connection).' '.mysqli_errno($connection));
    } else {
        $message = "Password Updated Successfully";
        //header("Location: signin.php");
    }
    $query = "UPDATE user SET recovery = null WHERE email = '{$_SESSION['email']}'";
    $recovery_null_query = mysqli_query($connection, $query);
    $_SESSION['email'] = null;
    session_destroy();
    header("Location: signin.php");
}

?>