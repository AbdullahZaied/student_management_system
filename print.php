<?php include "connection.php" ?>
<?php include "functions.php" ?>
<?php
   if(!isset($_SESSION['id'])){
       header("Location: signin.php");
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Registration Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
    <script>
        function onClick(){
            document.getElementById('trick').style.display="none";
            window.print();
        }
    </script>
</head>
<body style="font-sixe:30px">
    <div id="trick" style="position: fixed; top: 50px; right: 70px; z-index: 1; display: block;">
        <button type="button" class="btn btn-outline-warning" onclick="onClick()">Print Me</button>
    </div>
    <div class="wrapper">
       <div class="row">
           <div class="col-12" style="padding-top: 50px;">
           
           <h3 style="text-align: center; margin: 2px">Heaven's Light is Our Guide</h3>
           <h2 style="text-align: center; margin: 2px">RAJSHAHI UNIVERSITY OF ENGINEERING & TECHNOLOGY, BANGLADESH</h2>
           <h3 style="text-align: center; margin: 3px; text-decoration: underline;">Course Registration Form</h3>
           <h1 style="text-align: center; margin: 10px; font-style: oblique;">Department: <?php echo $_SESSION['department'] ?></h1>
           <br>
           <table class="table table-sm table-bordered" style="font-size:25px;">
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
                     <th scope="row">Previous earned credit: </th>
                     <td><?php getCredit() ?></td>
                 </tr>
                 <tr>
                     <th scope="row">Course no. of Backlog courses</th>
                     <td colspan="3"><?php echo "Here will be the backlogs!"?></td>
                 </tr> 
              </tbody> 
           </table>
           <br><br>
           </div>
       </div>
       <div class="row">
            <div class="col-12">
                    <h2 style="text-align: center; font-weight: bold">Courses to be registered in this semester:</h2>
                    <br>
                    <table class="table table-bordered" style=" font-size:25px">
                        <thead style="text-align: center">
                        <th>Course No</th>
                        <th>Course Title</th>
                        <th>Credit</th>
                        </thead>
                        <tbody>
                        <?php
                        include('connection.php');
                        
           $query = "SELECT CourseNo, CourseTitle, Credit FROM courselist WHERE SiNo IN(SELECT Course_SiNo FROM course_registration WHERE id = {$_SESSION['id']} AND term = {$_SESSION['term']} AND sem = {$_SESSION['sem']})";
                        $get_course_list_query =mysqli_query($connection,$query);
               if(!$get_course_list_query){
                        die("QUERY Failed aa "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
                    }
                        $total_credit = 0;
                        while($row=mysqli_fetch_array($get_course_list_query)){
                            $total_credit += $row['Credit'];
                        ?>
                        <tr style="text-align: center">
                        <td><?php echo $row['CourseNo']; ?></td>
                        <td style="text-align: left"><?php echo $row['CourseTitle']; ?></td>
                        <td><?php echo $row['Credit']; ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <th scope="row" colspan="2" style="text-align: right; padding-right: 6.75rem;">Total Credit of this Semester</th>
                            <td style="text-align: center"><?php echo $total_credit; ?></td>
                        </tr>
                        </tbody>
                    </table>
                    <br><br><br>
                <table class="table table-borderless" style=" font-size:25px">
                    <tr>
                        <td colspan="3" style="padding:0; padding-left: 14px;">Advisor's Comment (if Any) ..<?php $i = 60; while($i){echo "...";$i--;}?></td>
                    </tr>
                    <tr>
                        <td colspan="3"><?php $i = 80; while($i){echo "...";$i--;} ?></td>
                    </tr>
                    <tr><td colspan="3" style="height: 70px"></td></tr>
                    <tr style="text-align: center;">
                        <td style="padding:0">
                        <img src="<?php signatureLink(); ?>" alt="signature" style="width:300px; height: 80px;">
                       </td>
                        <td style="padding:0">                        </td>
                        <td style="padding:0">                        </td>
                    </tr>
                    <tr style="padding:0;text-align: center;">
                        <td style="padding:0; text-decoration: overline;">Signature of the Student</td>
                        <td style="padding:0; text-decoration: overline;">Signature of the Adviser</td>
                        <td style="padding:0; text-decoration: overline;">Signature of the Controller</td>
                    </tr>
                </table>
                <br><br>
                <h3 style="font-weight: bold; padding-left:15px">
                Date: <?php
                    include('connection.php');
                    
                    $q = "SELECT date FROM course_registration WHERE id = {$_SESSION['id']} AND term = {$_SESSION['term']} AND sem = {$_SESSION['sem']}";
                    
                    $select_date_query = mysqli_query($connection,$q);
                    if(!$select_date_query){
                        die("QUERY Failed "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
                    }
    
                    while($row = mysqli_fetch_array($select_date_query)){
                        $date = $row['date'];
                    }
                    echo $date;
                    
                ?>
                </h3>
                <br>
                <hr style="background-color: black;">
                <p style="text-align: center; font-size: 20px; color: #a6a6a6; font-style: oblique;">RUET Student Management System<br>Powered by Zaied</p>
                </div>
        </div>
    </div>
    <script src="js/slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
