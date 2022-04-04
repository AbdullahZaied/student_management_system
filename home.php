<?php include "connection.php" ?>
<?php session_start(); ?>
<?php
   if(!isset($_SESSION['id'])){
       header("Location: signin.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home Page</title>    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
        <?php include "header.php" ?>
        <div class="wrapper" style="margin-bottom: -80px; min-height:100%">
            
        </div>
        <?php include "footer.php" ?>
    <script src="js/slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

