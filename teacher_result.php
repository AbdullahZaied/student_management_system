<?php include "connection.php" ?>
<?php session_start(); ?>
<?php
   $value = "display: none";
   if(!isset($_SESSION['tid'])){
       header("Location: signin.php");
   }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Result Publish</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
</head>
<body>
  <?php include "teacher_header.php" ?>
  
  <div class="wrapper" style="padding-top:20px; margin-bottom: -80px; min-height:100%">
   <div class="row">
   <div class="col-4"></div>
   <div class="col-6">
    <form class="form-inline" action="teacher_result.php" method="post" enctype="multipart/form-data">
      <div class="form-group mx-sm-3 mb-2">
            <select name="course" class="form-control" id="course">
            <option selected>Choose your course</option>
            <?php
            $query = "SELECT * FROM responsibility WHERE id = '{$_SESSION['tid']}'";
            $select_course_query = mysqli_query($connection,$query);
            while($row = mysqli_fetch_array($select_course_query)){
                $db_department = $row['department'];
                $db_series = $row['series'];
                $db_section = $row['section'];
                $db_courseNo = $row['CourseNo'];
                $db_term = $row['term'];
                $db_sem = $row['sem'];
                
                $opt = $db_department.','.$db_series.','.$db_section.','.$db_courseNo;
                ?>
            <option><?php echo $opt ?></option>
            <?php
            }
            ?>
            </select>
      </div>
      <div class="form-group mx-sm-3 mb-2">
            <select name="exam" class="form-control" id="course">
            <option selected>Choose Exam</option>
            <option>ct_1</option>
            <option>ct_2</option>
            <option>ct_3</option>
            <option>ct_4</option>
            <option>attendance</option>
            <option>performance</option>
            <option>quiz</option>
            <option>viva</option>
            <option>final</option>
          </select>
      </div>
<button name="select" type="submit" class="btn btn-primary mb-2">LOAD</button>
    </form>
   </div>
   <div class="col-2"></div>
   </div>
    
    <?php
    if(isset($_POST['select'])){
        $value = "display: block";
        $exam = $_POST['exam'];
        $_SESSION['exam'] = $exam;
        
        $opt = $_POST['course'];
        list($department, $series, $section, $courseNo) = explode(",",$opt);
        
        //selecting course term,sem from responsility
        $query = "SELECT term, sem FROM responsibility WHERE department ='{$department}' AND series = {$series} AND section = '{$section}' AND CourseNo = '{$courseNo}'";
        $select_ts_query = mysqli_query($connection, $query);
        if(!$select_ts_query){
            die("QUERY Failed 1 "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
        }
        while($row = mysqli_fetch_array($select_ts_query)){
            $term   = $row['term'];
            $sem    = $row['sem'];
        }
        
        //course searching: Course Code and type
        $query = "SELECT * FROM courselist WHERE CourseNo = '{$courseNo}' AND term = {$term} AND sem = {$sem}";
        
        $select_course_query = mysqli_query($connection, $query);
        if(!$select_course_query){
            die("QUERY Failed "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
        }
        while($row = mysqli_fetch_array($select_course_query)){
            $SiNo = $row['SiNo'];
            $type = $row['Type'];
            $_SESSION['SiNo'] = $SiNo;
        }
        //select student id for marking
        $query = "SELECT id FROM course_registration WHERE course_SiNo = {$SiNo} AND id IN(SELECT id FROM user WHERE department = '{$department}' AND series = {$series} AND section = '{$section}' AND term = {$term} AND sem = {$sem})";
        
        $select_student_query = mysqli_query($connection, $query);
        ?>
    
    
    
    <div class="row" id="table" style="display: <?php echo $value ?>">
    <div class="col-4"></div>
    <div class="col-4">
    <table class="table table-borderless" style="text-align: center">
        <thead>
            <th>Roll</th>
            <th>Marks</th>
        </thead>
        <tbody>
            <form action="teacher_result.php" method="post" enctype="multipart/form-data">
            <?php
            while($row = mysqli_fetch_array($select_student_query)){
            $db_id = $row['id'];
            ?>
            <tr>
            <td style="text-align: center; padding: 0px 0px 0px 0px">
            <div class="form-group">
            <?php echo $db_id ?>
            <input type="hidden" class="form-control" name="id[]" value="<?php echo $db_id ?>"> 
            </div>
            </td>
            <td style="text-align: center; padding: 0px 0px 0px 0px">
            <div class="form-group">
            <input type="text" class="form-control" placeholder="Marks" name="mark[]"> 
            </div>
            </td>    
            </tr>
            <?php } ?>
            <tr>
            <td colspan="2">
            <button name="upload" type="submit" class="btn btn-primary mb-2">Submit</button>
            </td>
            </tr>
            </form>
        </tbody>
    </table>
        <?php } ?>
    </div>
    <div class="col-4"></div>                  
  </div>
  <?php
    if(isset($_POST['upload'])){
        foreach (array_combine($_POST['id'],$_POST['mark']) as $id => $mark) {
                
            $query = "UPDATE result set {$_SESSION['exam']} = {$mark} WHERE id = {$id} AND course_SiNo = '{$_SESSION['SiNo']}' AND term = {$db_term} AND sem = {$db_sem}";
            $set_result_query = mysqli_query($connection,$query);
            
            $query = "SELECT * FROM result WHERE id = {$id} AND course_SiNo = {$_SESSION['SiNo']} AND term = {$db_term} AND sem = {$db_sem}";
            $get_ctmark_query = mysqli_query($connection,$query);
            
            while($row = mysqli_fetch_array($get_ctmark_query)){
                $ct_1 = $row['ct_1'];
                $ct_2 = $row['ct_2'];
                $ct_3 = $row['ct_3'];
                $ct_4 = $row['ct_4'];
                
                $ignore = min($ct_1,$ct_2,$ct_3,$ct_4);
                $ct_avg = ceil(($ct_1 + $ct_2 + $ct_3 + $ct_4 - $ignore)/3);
                
                $query = "UPDATE result set ct_avg = {$ct_avg} WHERE id = {$id} AND course_SiNo = '{$_SESSION['SiNo']}' AND term = {$db_term} AND sem = {$db_sem}";
                $set_ct_avg_query = mysqli_query($connection,$query);
            }
        }
        $_SESSION['exam'] = null; unset($_SESSION["exam"]);
        $_SESSION['SiNO'] = null; unset($_SESSION["SiNo"]);   
        
        }
        
?>
   
    </div>
    <?php include "footer.php" ?>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>