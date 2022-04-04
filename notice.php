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
    <title>Notices</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
</head>
<body>
    <div style="position: relative; min-height: 100vh;">
    <?php include "header.php" ?>
    <div class="wrapper" style="padding:15px 300px 125px 300px">
<?php
    $query = "SELECT * FROM user WHERE id = {$_SESSION['id']}";
    $get = mysqli_query($connection,$query);
    while($row = mysqli_fetch_array($get)){
        $series = $row['series'];
        $dept = $row['department'];
        $sec = $row['section'];
    } 
    $cond = $dept.",".$series.",".$sec;
    
    $query = "SELECT * FROM notice WHERE target = '{$cond}' OR target = 'ALL' ORDER by date DESC";
    $load_notice = mysqli_query($connection,$query);
    while($row = mysqli_fetch_array($load_notice)){
        $tid         = $row['id'];
        $subject     = $row['subject'];
        $description = $row['description'];
        $file        = $row['file'];
        $date        = $row['date'];
        
        $query = "SELECT name FROM teacher WHERE id = {$tid}";
        $get_name = mysqli_query($connection,$query);
        $name = mysqli_fetch_array($get_name)['name'];
?>
    <div class="row">
        <table class="table table-sm table-bordered" style="border-width:5px">
           <thead>
             <th><?php echo "Title: ".$subject ?></th>
             <th style="text-align: right"><?php echo "Date: ".$date ?></th>
           </thead>
           <thead>
               <th colspan="2" style="text-align: center"><?php echo "Author: ".$name ?></th>
           </thead>
           <tbody>
               <tr>
                   <th>Description: </th>
                   <td><?php echo $description ?></td>
               </tr>
               <?php
               if($file){ ?>
               <tr>
                   <td colspan="2" style="text-align: center">
                            <img src="<?php echo $file; ?>">
                   </td>
               </tr>
               <?php } ?>
           </tbody>
        </table>
    </div>
<?php
    }

?>    
    </div>
    <?php include "footer.php" ?>
    </div>
</body>
</html>