<?php include "connection.php" ?>
<?php include "functions.php" ?>
<?php
   if(!isset($_SESSION['id'])){
       header("Location: signin.php");
   }
?>
<?php
    if (isset($_POST['submit'])){
        foreach ($_POST['id'] as $id):
        //fetching course credit
        $query = "SELECT Type, credit FROM courselist WHERE SiNo = '$id';";
        $select_credit_query = mysqli_query($connection,$query);
        print_r($select_credit_query);
        while($srow=mysqli_fetch_array($select_credit_query)){
           $credit  = $srow['credit'];
           $type    = $srow['Type'];
        }
        //putting student in exam list (result table)
        $query = "INSERT INTO result(id, course_SiNo, type, credit, term, sem) VALUES({$_SESSION['id']},{$id}, '{$type}', {$credit}, '{$_SESSION['term']}', '{$_SESSION['sem']}')";
        $start_exam_query = mysqli_query($connection,$query); 
        //fetching the time of registration
        $timezone = 'Asia/Dhaka';
        date_default_timezone_set($timezone);
        $date = date('d.m.Y');
        
        //updating user with registration date
        $query = "UPDATE user SET date_of_registration = '{$date}' WHERE id = '{$_SESSION['id']}'";
        $course_registration_query=mysqli_query($connection,$query);
        
        //inserting into course registration table
        $query = "INSERT INTO course_registration VALUES ('{$_SESSION['id']}','{$_SESSION['term']}','{$_SESSION['sem']}',$id,$credit,'{$date}')";
        $course_registration_query=mysqli_query($connection,$query);

        endforeach;
        header("Location: print.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
    
</head>
<body>
    <div style="position: relative; min-height: 100vh;">
    <?php include "header.php" ?>
    <div class="wrapper" style="padding-bottom: 125px;">
       <div class="row">
           
           <div class="col-2"></div>
           <div class="col-8" style="padding-top: 15px;">
           
           <h5 style="text-align: center; margin: 2px">Heaven's Light is Our Guide</h5>
       <h4 style="text-align: center; margin: 2px">RAJSHAHI UNIVERSITY OF ENGINEERING & TECHNOLOGY, BANGLADESH</h4>
       <p style="text-align: center; margin: 3px; text-decoration: underline;">Course Registration Form</p>
       <h3 style="text-align: center; margin: 10px; font-style: oblique;">Department: <?php echo $_SESSION['department'] ?></h3>
       <table class="table table-sm table-bordered">
          <tbody>
             <tr>
                 <th scope="row">Roll No.: </th>
                 <td><?php echo $_SESSION['id'] ?></td>
                 <th scope="row">Registration No. with Session: </th>
                 <td><?php echo $_SESSION['regno']." / ".$_SESSION['series']."-".($_SESSION['series']+1) ?></td>
             </tr>
             <tr>
                 <th scope="row">Name: </th>
                 <td colspan="3"><?php echo $_SESSION['name'] ?></td>
             </tr>
             <tr>
                 <th scope="row">Academic session with semester: </th>
                 <td><?php getASWS() ?></td>
                 <th scope="row">Previous: earned credit: </th>
                 <td><?php getCredit() ?></td>
             </tr>
             <tr>
                 <th scope="row">Course no. of Backlog courses</th>
                 <td colspan="3"><?php echo "Here will be the backlogs!"?></td>
             </tr> 
          </tbody> 
       </table>
           
       </div>
           <div class="col-2"></div>
           
       </div>
       <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <form method="post" target="_blank" onsubmit="return confirm('Do you really want to submit the form?');">
                    <h6 style="font-weight: bold">Courses to be registered in this semester:</h6>
                    <table class="table table-bordered">
                        <thead style="text-align: center">
                        <th>Course No</th>
                        <th>Course Title</th>
                        <th>Credit</th>
                        <th>Select</th>
                        </thead>
                        <tbody>
                        <?php
                        include('connection.php');
                        $query = "select * from courselist WHERE term = {$_SESSION['term']} AND sem = {$_SESSION['sem']} AND Department = '{$_SESSION['department']}'";
                        $get_course_list_query =mysqli_query($connection,$query);
        
        if(!$get_course_list_query){
            die("QUERY Failed "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
        }
                        while($row=mysqli_fetch_array($get_course_list_query)){
                            ?>
                        <tr style="text-align: center">
                        <td><?php echo $row['CourseNo']; ?></td>
                        <td style="text-align: left"><?php echo $row['CourseTitle']; ?></td>
                        <td><?php echo $row['Credit']; ?></td>
                        <td>
                        <input type="checkbox" value="<?php echo $row['SiNo']; ?>" name="id[]" checked>
                        </td>
                        </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <button type="submit" name="submit" class="btn btn-primary col-12" style="text-align: center">Submit</button>
                    </form>
                </div>
        </div>
    </div>
    <?php include "footer.php" ?>
    </div>
    <script src="js/slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
