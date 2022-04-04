<?php include "connection.php" ?>
<?php session_start(); ?>
<?php
   if(!isset($_SESSION['id'])){
       header("Location: signin.php");
   }
?>

<?php

if(isset($_POST['change'])){
    $name;
    if (isset($_FILES["file"]["name"])) {

        $name = $_FILES["file"]["name"];
        //have to do optimization here for image existance 
        $tmp_name = $_FILES['file']['tmp_name'];
        $error = $_FILES['file']['error'];

        if (!empty($name)) {
            $location = "img/";

            if  (move_uploaded_file($tmp_name, $location.$name)){
                echo "Uploaded";
            }
            
            $query = "UPDATE user SET pic = 'img/{$name}' WHERE id = {$_SESSION['id']}";
    
            $image_store_query = mysqli_query($connection, $query);
            if(!$image_store_query){
            die("Image storage failed ".mysqli_error($connection).' '.mysqli_errno($connection));
        }
            

        } else {
            echo "please choose a file";
        }
        
    }
    
    if (isset($_FILES["file1"]["name"])) {

        $name = $_FILES["file1"]["name"];
        //have to do optimization here for image existance 
        $tmp_name = $_FILES['file1']['tmp_name'];
        $error = $_FILES['file1']['error'];

        if (!empty($name)) {
            $location = "signature/";

            if  (move_uploaded_file($tmp_name, $location.$name)){
                echo "Uploaded";
            }
            
            $query = "UPDATE user SET signature = 'signature/{$name}' WHERE id = {$_SESSION['id']}";
    
            $signature_store_query = mysqli_query($connection, $query);
            if(!$signature_store_query){
                die("Signature storage failed ".mysqli_error($connection).' '.mysqli_errno($connection));
            }   

        } else {
            echo "please choose a file";
        }
        
    }
    header("Location: profile.php");
  
}

?>