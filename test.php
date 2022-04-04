<?php include "connection.php" ?>
<?php session_start(); ?>
<?php
    if(!isset($_SESSION['tid'])){
       header("Location: signin.php");
    }
    if(!isset($_SESSION['trole'])){
           header("Location: teacher_home.php");
       }
?>
<?php
    $get_id = "SELECT id FROM user WHERE ".$_SESSION['trole'];

    $get_t_s = "SELECT term, sem FROM series WHERE series = (SELECT series FROM course_adviser WHERE id = {$_SESSION['tid']})";

    $query = "SELECT SUM(credit) tcr, SUM(gpa) tgpa FROM result WHERE id IN ($get_id) AND (term,sem) =($get_t_s) AND gpa > 0";
    $operation = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($operation)){
        print_r($row);
        echo "<br><br><br>";
    }

    
?>