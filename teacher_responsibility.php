<?php session_start() ?>
<?php
    $number;
    $value = "display: none";
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
        <div class="wrapper" style="padding-left: 300px; padding-right: 300px; margin-bottom: -80px; min-height:100%">
            <div class="row">
                <form class="form-inline" action="teacher_responsibility.php" method="post" enctype="multipart/form-data">
                  <div class="form-group mb-2">
                    <label for="staticEmail2" class="sr-only">courses</label>
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Number of courses:">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="course" class="sr-only">How many?</label>
                    <input name="number" type="text" class="form-control" id="inputPassword2" placeholder="How many?">
                  </div>
                  <button onclick="onClick()" name="submit" type="submit" class="btn btn-primary mb-2">Submit</button>
                </form>
            </div>
            <?php
                if(isset($_POST['submit'])){
                    $number = $_POST['number'];
                    $value = "display: block";
            ?>
            
            <div class="row" id="assign" style="display: <?php echo $value ?>">
               <table class="table table-bordered" style="text-align: center">
               <thead>
                   <th>Department</th>
                   <th>Series</th>
                   <th>Section</th>
                   <th>Year</th>
                   <th>Semester</th>
                   <th>Course Code</th>
               </thead>
               <form action="teacher_assign.php" method="post" enctype="multipart/form-data">
               <tbody>
               <!---here post started --->
                <input type='hidden' name='hidden_value' value="<?php echo $number ?>" />
                <?php
                while($number){
                ?>
                <tr>
                <td>
                <div class="form-group">
                <select name="<?php echo "department".$number ?>" class="form-control" id="department" required>
                <option selected>Choose...</option>
                <option>CSE</option>
                <option>EEE</option>
                <option>ECE</option>
                <option>ETE</option>
                <option>CE</option>
                <option>URP</option>
                <option>ARCH</option>
                <option>BECM</option>
                <option>ME</option>
                <option>IPE</option>
                <option>MTE</option>
                <option>GCE</option>
                <option>CFPE</option>
                <option>MSE</option>
                </select>
                </div> 
                </td>
                <td>
                <div class="form-group">
                <select name="<?php echo "series".$number ?>" class="form-control" id="series" required>
                <option selected>Choose...</option>
                <option>2015</option>
                <option>2016</option>
                <option>2017</option>
                <option>2018</option>
                </select>
                </div> 
                </td>
                <td>
                <div class="form-group">
                <select name="<?php echo "section".$number ?>" class="form-control" id="section" required>
                <option selected>Choose...</option>
                <option>A</option>
                <option>B</option>
                <option>C</option>
                </select>
                </div> 
                </td>
                <td>
                <div class="form-group">
                <select name="<?php echo "term".$number ?>" class="form-control" id="term" required>
                <option selected>Choose...</option>
                <option>1</option>
                <option>2</option>
                </select>
                </div> 
                </td>
                <td>
                <div class="form-group">
                <select name="<?php echo "sem".$number ?>" class="form-control" id="sem" required>
                <option selected>Choose...</option>
                <option>1</option>
                <option>2</option>
                </select>
                </div> 
                </td>    
                <td>
                <div class="form-group">
                <input type="text" name="<?php echo "course".$number ?>" class="form-control" id="course" placeholder="Course Code" required>
                </div>     
                </td>    
                </tr>
                <?php    
                $number--;
                }
                ?>
                <tr>
                <td colspan="6" style="padding:0; margin:0">
                    <div class="form-group">
                        <button name="confirm" type="submit" class="btn btn-primary col-12">Submit</button>
                    </div>
                </td>    
                </tr>
                <?php
                }
                ?>
                </tbody>
                </form>
                </table>
            </div>
            
                
            
        </div>
    <?php include "footer.php" ?>

    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>    
</body>
</html>