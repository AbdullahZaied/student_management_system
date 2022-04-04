<?php include "connection.php" ?>
<?php session_start() ?>
<?php
   if(!isset($_SESSION['tid'])){
       header("Location: signin.php");
   }
?>
<?php
    if (isset($_POST['confirm'])){
        
        $number = $_POST['hidden_value'];
        while($number){
            $d = "department".$number;
            $sr = "series".$number;
            $sn = "section".$number;
            $trm = "term".$number;
            $sem = "sem".$number;
            $c = "course".$number;
            $department = $_POST[$d];
            $series     = $_POST[$sr];
            $section    = $_POST[$sn];
            $term        = $_POST[$trm];
            $sem        = $_POST[$sem];
            $course     = $_POST[$c];
            
            $query = "INSERT INTO responsibility(id, department, series, section, CourseNo, term, sem) VALUES ('{$_SESSION['tid']}', '{$department}', '{$series}', '{$section}','{$course}','{$term}','{$sem}')";
            
            $course_registration_query = mysqli_query($connection,$query);
            
            $number--;
            
        }

        header("Location: teacher_home.php");
    }
?>