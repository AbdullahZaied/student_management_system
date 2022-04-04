<?php session_start() ?>
<?php
   if(!isset($_SESSION['tid'])){
       header("Location: signin.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
   <?php include "teacher_header.php" ?>
        <div class="wrapper" style="margin-bottom: -80px; min-height:100%">
            
            
        </div>
    <?php include "footer.php" ?>
    
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>    
</body>
</html>