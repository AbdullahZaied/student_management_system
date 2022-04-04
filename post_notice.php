<?php include "connection.php" ?>
<?php session_start(); ?>
<?php
   $value = "display: none";
   if(!isset($_SESSION['tid'])){
       header("Location: signin.php");
   }
?>
<?php
if(isset($_POST['submit'])){
    $dir = "";
    if (isset($_FILES["file"]["name"])){
        $name = $_FILES["file"]["name"];
        $tmp_name = $_FILES['file']['tmp_name'];
        $error = $_FILES['file']['error'];
        if(!empty($name)){
            $location = "notice/";
            move_uploaded_file($tmp_name, $location.$name);
            $dir = "notice/{$name}";
        }
    }
    $hts = $_POST['target'];
    $sub = $_POST['subject'];
    $description = $_POST['description'];
    //fetching the time of registration
    $timezone = 'Asia/Dhaka';
    date_default_timezone_set($timezone);
    $date = date('d.m.Y');
    
    $query = "INSERT INTO notice VALUES({$_SESSION['tid']},'{$hts}','{$sub}', '{$description}','{$dir}','{$date}')";
    $set_notice = mysqli_query($connection, $query);
}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Notice</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div style="position: relative; min-height: 100vh;">
    <?php include "teacher_header.php" ?>
    <div class="wrapper" style="padding:15px 300px 125px 300px">
        <table class="table table-dark">
           <thead style="text-align: center">
               <th colspan="2">Post Notice</th>
           </thead>
<form action="post_notice.php" method="post" enctype="multipart/form-data">
           <tbody>
               <tr>
                   <th>To</th>
                   <td>
<div class="form-group mx-sm-3 mb-2">
    <select name="target" class="form-control" id="target">
    <option selected>ALL</option>
    <?php
    $query = "SELECT * FROM responsibility WHERE id = '{$_SESSION['tid']}'";
    $select_course_query = mysqli_query($connection,$query);
    while($row = mysqli_fetch_array($select_course_query)){
        $db_department = $row['department'];
        $db_series = $row['series'];
        $db_section = $row['section'];
        $opt = $db_department.','.$db_series.','.$db_section;
        ?>
    <option><?php echo $opt ?></option>
    <?php
    }
    ?>
    </select>
</div>
                   </td>
               </tr>
               <tr>
                   <th>Subject</th>
                   <td>
<div class="form-group">
    <input type="text" name="subject" class="form-control" id="subject" placeholder="type subject">
</div>
                   </td>
               </tr>
               <tr>
                   <th>Description</th>
                   <td>
<div class="form-group">
    <textarea name="description" class="form-control" id="description" rows="3" placeholder="Type here..."></textarea>
</div>
                   </td>
               </tr>
               <tr>
                   <th>File</th>
                   <td>
<div class="form-group">
    <input type="file" name="file" class="form-control-file" id="file">
</div>
                   </td>
               </tr>
               <tr>
                   <td colspan="2">
<button name="submit" type="submit" class="btn btn-secondary btn-lg btn-block">POST</button>
                   </td>
               </tr>
           </tbody>
</form>            
        </table>
    </div>
    <?php include "footer.php" ?>
    </div>
  
</body>
</html>