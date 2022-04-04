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
    <title>Result</title>    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
        <div style="position: relative; min-height: 100vh;">
        <?php include "header.php" ?>
        <div class="wrapper" style=" padding-top: 30px; padding-left: 40px; padding-right:40px; padding-bottom: 125px;">
            <div class="row">
                <table class="table table-bordered table-sm table-dark table-striped">
                  <thead>
                      <th colspan="11" style="text-align: center">Theory Result</th>
                  </thead>
                   <thead style="text-align: center">
                       <th>Course No</th>
                       <th>CT 1</th>
                       <th>CT 2</th>
                       <th>CT 3</th>
                       <th>CT 4</th>
                       <th>CT AVG</th>
                       <th>Attendance</th>
                       <th>Final</th>
                       <th>Total</th>
                       <th>GPA</th>
                       <th>Status</th>
                   </thead>
                   <tbody style="text-align: center">
<?php 
    $query = "SELECT * FROM result WHERE id = {$_SESSION['id']} AND type = 'theory' AND term = {$_SESSION['term']} AND sem = {$_SESSION['sem']}";
    $select_theory_query = mysqli_query($connection, $query);
    if(!$select_theory_query){
        die("Failed"." ".mysqli_error($connection)." ".mysqli_error($connection));
    }
    while($row = mysqli_fetch_array($select_theory_query)){
        $ct_1       = $row['ct_1'];
        $ct_2       = $row['ct_2'];
        $ct_3       = $row['ct_3'];
        $ct_4       = $row['ct_4'];
        $ct_avg     = $row['ct_avg'];
        $attendance = $row['attendance'];
        $final      = $row['final'];
        $total      = $row['total'];
        $gpa        = $row['gpa'];
        $sts        = $row['status'];
        
        $cid = $row['course_SiNo'];
        $query = "SELECT CourseNo FROM courselist WHERE SiNo = {$cid}";
        $select_course_query = mysqli_query($connection, $query);
        while($Crow = mysqli_fetch_array($select_course_query)){
            $course = $Crow['CourseNo'];
        }
        
        
?>
                    <tr>
                        <td><?php echo $course ?></td>
                        <td><?php echo $ct_1 ?></td>
                        <td><?php echo $ct_2 ?></td>
                        <td><?php echo $ct_3 ?></td>
                        <td><?php echo $ct_4 ?></td>
                        <td><?php echo $ct_avg ?></td>
                        <td><?php echo $attendance ?></td>
                        <td><?php echo $final ?></td>
                        <td><?php echo $total ?></td>
                        <td><?php echo $gpa ?></td>
                        <td><?php echo $sts ?></td>
                    </tr>          
<?php } ?>
                   </tbody>
                    
                </table>
            </div>
            <div class="row">
                <table class="table table-bordered table-sm table-dark table-striped">
                  <thead>
                      <th colspan="11" style="text-align: center">Sessional Result</th>
                  </thead>
                   <thead style="text-align: center">
                       <th>Course No</th>
                       <th>Atttendance</th>
                       <th>Performance</th>
                       <th>Lab Final</th>
                       <th>Quiz</th>
                       <th>Viva</th>
                       <th>Total</th>
                       <th>GPA</th>
                       <th>Status</th>
                   </thead>
                   <tbody style="text-align: center">
<?php 
    $query = "SELECT * FROM result WHERE id = {$_SESSION['id']} AND type = 'sessional' AND term = {$_SESSION['term']} AND sem = {$_SESSION['sem']}";
    $select_theory_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($select_theory_query)){
        $performance = $row['performance'];
        $quiz        = $row['quiz'];
        $viva        = $row['viva'];
        $attendance  = $row['attendance'];
        $total       = $row['total'];
        $gpa         = $row['gpa'];
        $final      = $row['final'];
        $sts        = $row['status'];
        
        $cid = $row['course_SiNo'];
        $query = "SELECT CourseNo FROM courselist WHERE SiNo = {$cid}";
        $select_course_query = mysqli_query($connection, $query);
        while($Crow = mysqli_fetch_array($select_course_query)){
            $course = $Crow['CourseNo'];
        }
        
        
?>
                    <tr>
                        <td><?php echo $course ?></td>
                        <td><?php echo $attendance ?></td>
                        <td><?php echo $performance ?></td>
                        <td><?php echo $final ?></td>
                        <td><?php echo $quiz ?></td>
                        <td><?php echo $viva ?></td>
                        <td><?php echo $total?></td>
                        <td><?php echo $gpa ?></td>
                        <td><?php echo $sts ?></td>
                    </tr>          
<?php } ?>
                   </tbody>
                    
                </table>
            </div>
            <div class="row">
                <table class="table table-sm table-bordered table-dark">
                    <thead style="text-align: center">
                        <th>Semester Earned Credit</th>
                        <th>Total Earned Credit</th>
                        <th>Semester GPA</th>
                        <th>CGPA</th>
                    </thead>
                    <tbody style="text-align: center">
                        <tr>
<?php 
    $query = "SELECT tcr FROM result_track WHERE id = {$_SESSION['id']}";
    $op = mysqli_query($connection,$query);
    $tcr = (mysqli_fetch_array($op))['tcr'];
?>
                            <td><?php echo $tcr ?></td>
<?php 
    $query = "SELECT SUM(tcr) FROM result_track WHERE id = {$_SESSION['id']}";
    $op = mysqli_query($connection,$query);
    $stcr = (mysqli_fetch_array($op))['SUM(tcr)'];
?>
                            <td><?php echo $stcr ?></td>
<?php 
    $query = "SELECT sgpa FROM result_track WHERE id = {$_SESSION['id']}";
    $op = mysqli_query($connection,$query);
    $sgpa = (mysqli_fetch_array($op))['sgpa'];
?>
                            <td><?php echo $sgpa ?></td>
<?php 
    $query = "SELECT cgpa FROM user WHERE id = {$_SESSION['id']}";
    $op = mysqli_query($connection,$query);
    $cgpa = (mysqli_fetch_array($op))['cgpa'];
?>
                            <td><?php echo $cgpa ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include "footer.php" ?>
        </div>
    <script src="js/slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

