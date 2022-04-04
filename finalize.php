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

    $query = "SELECT * FROM result WHERE id IN ($get_id) AND (term,sem) =($get_t_s)";
    $operation = mysqli_query($connection, $query);

    //Loading id from result table with all the attributes then change status,gpa
    while($row = mysqli_fetch_array($operation)){
        $id         = $row['id'];
        $course     = $row['course_SiNo'];
        $credit     = $row['credit'];
        $term       = $row['term'];
        $sem        = $row['sem'];
        $attendance = $row['attendance'];
        $ct_avg     = $row['ct_avg'];
        $final      = $row['final'];
        $performance= $row['performance'];
        $quiz       = $row['quiz'];
        $viva       = $row['viva'];
        
        $total = $attendance + $ct_avg + $final + $performance + $quiz + $viva;
        
        $query = "UPDATE result set total = {$total} WHERE id = $id AND course_SiNo = {$course} AND term = $term AND sem = $sem";
        $sum_total = mysqli_query($connection, $query);
        
        if(!$sum_total){
            die("QUERY Failed "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
        }
        
        if($attendance == 0 || $final == null){
            $query = "UPDATE result set status = 'X' WHERE id = $id AND course_SiNo = {$course} AND term = $term AND sem = $sem";
            $change_status = mysqli_query($connection, $query);
            
            $query = "INSERT into troubles VALUES({$id},'{$course}',{$credit},'X',{$term},{$sem})";
            $add_to_troubles = mysqli_query($connection, $query);
        }elseif($total < 40){
            $query = "UPDATE result set status = 'backlog' WHERE id = $id AND course_SiNo = {$course} AND term = $term AND sem = $sem";
            $change_status = mysqli_query($connection, $query);
            
            $query = "INSERT into troubles VALUES({$id},'{$course}',{$credit},'backlog',{$term},{$sem})";
            $add_to_troubles = mysqli_query($connection, $query);
        }else{
            if($total>79){
                $sts = "A+";
                $grade = 4.00;
            }elseif($total>74){
                $sts = "A";
                $grade = 3.75;
            }elseif($total>69){
                $sts = "A-";
                $grade = 3.50;
            }elseif($total>64){
                $sts = "B+";
                $grade = 3.25;
            }elseif($total>59){
                $sts = "B";
                $grade = 3.00;
            }elseif($total>54){
                $sts = "B-";
                $grade = 2.75;
            }elseif($total>49){
                $sts = "C+";
                $grade = 2.50;
            }elseif($total>44){
                $sts = "C";
                $grade = 2.25;
            }elseif($total>39){
                $sts = "D";
                $grade = 2.00;
            }
            $query = "UPDATE result set status = '{$sts}', gpa = {$grade} WHERE id = $id AND course_SiNo = {$course} AND term = $term AND sem = $sem";
            $change_grade_status = mysqli_query($connection, $query);
        }
    }

    $get_id = "SELECT id FROM user WHERE ".$_SESSION['trole'];

    $get_t_s = "SELECT term, sem FROM series WHERE series = (SELECT series FROM course_adviser WHERE id = {$_SESSION['tid']})";

    $query = "SELECT id, term,sem, SUM(credit) tcr, SUM(gpa*credit) tgc FROM result WHERE id IN ($get_id) AND (term,sem) =($get_t_s) AND gpa > 0 GROUP BY id";
    $operation = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($operation)){
        $id = $row['id'];
        $term = $row['term'];
        $sem = $row['sem'];
        $tcr = $row['tcr'];
        $tgc = $row['tgc'];
        
        $sgpa = $tgc/$tcr;
        //update semester result
        $query = "INSERT INTO result_track VALUES({$id},{$term},{$sem},{$tcr},{$tgc},{$sgpa})";
        $update_track = mysqli_query($connection, $query);
        
        //get SUM(credit) and SUM(credit*gpa)
        $query = "SELECT SUM(tcr), SUM(tgc) FROM result_track WHERE id = {$id}";
        $get_sum = mysqli_query($connection, $query);
        while($Crow = mysqli_fetch_array($get_sum)){
            $tcr = $Crow['SUM(tcr)'];
            $tgc = $Crow['SUM(tgc)'];
        }
        $cg = round($tgc/$tcr,2);
        //updating cgpa in profile
        $query = "UPDATE user set CGPA = {$cg}, credit = {$tcr} WHERE id = {$id}";
        $update_cgpa_cr = mysqli_query($connection, $query);
        if(!$update_cgpa_cr){
            die("QUERY Failed "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
        }
    }
    header("Location: teacher_home.php");
?>