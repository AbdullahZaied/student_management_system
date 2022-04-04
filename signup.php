<?php include "connection.php" ?>
<?php session_start(); ?>
<?php
    if(isset($_SESSION['id'])){
       header("Location: home.php");
   }
?>
<?php   
if(isset($_POST['submit'])){
    $name       = $_POST['name'];
    $id         = $_POST['id'];
    $reg        = $_POST['reg'];
    $department = $_POST['department'];
    $section    = $_POST['sec'];
    $series     = $_POST['series'];
    $email      = $_POST['email'];
    $contact    = $_POST['contact'];
    $password   = $_POST['password'];
    
    $query = "INSERT INTO user(name, id, department, series, email, password, regno, section, contact, role) VALUES ('{$name}', {$id}, '{$department}', '{$series}', '{$email}', '{$password}', {$reg}, '{$section}', '{$contact}', 'subscriber');";
    
    $register_user_query = mysqli_query($connection, $query);
    if(!$register_user_query){
        die("QUERY Failed ".mysqli_error($connection).' '.mysqli_errno($connection));
    }
    header("Location: signin.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign Up</title>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div style="position: relative; min-height: 100vh;">
        <div class="wrapper" style="padding-bottom: 90px; padding-top:15px">
           <h1 style="text-align: center; font-style: oblique">Fill up the informations to sign up</h1>
           <hr>
            <div class="row" style="margin: 0px; padding-bottom: 20px">
            <div class="col-3"></div>
            <div class="col-6">
            <form action="signup.php" method="post">
            <div class="form-group">
            <label for="name"><b>Name</b></label>
            <input type="text" class="form-control" placeholder="Enter Name" name="name" required> 
            </div>
            <div class="form-row">
            <div class="form-group col-md-5">
            <label for="id"><b>ID No</b></label>
            <input type="text" class="form-control" placeholder="Enter ID" name="id" required>
            </div>
            <div class="form-group col-md-7">
            <label for="id"><b>Registration Number</b></label>
            <input type="text" class="form-control" placeholder="Enter Registration No" name="reg" required>
            </div>
            </div>
            
            <div class="form-group">
            <label for="series"><b>Series</b></label>
            <input type="text" class="form-control" placeholder="20XX" name="series" required>
            </div>
            
            
            <div class="form-row">
            <div class="form-group col-md-6">
            <label for="department"><b>Department</b></label>
            <select name="department" class="form-control" id="department">
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
            <div class="form-group col-md-6">
            <label for="department"><b>Section</b></label>
            <select name="sec" class="form-control" id="sec">
            <option selected>Choose...</option>
            <option>A</option>
            <option>B</option>
            <option>C</option>
            </select>
            </div>
            </div>

            
            <div class="form-row">
            <div class="form-group col-md-6">
            <label for="email"><b>Email</b></label>
            <input type="text" class="form-control" placeholder="user@example.com" name="email" required>
            </div>
            <div class="form-group col-md-6">
            <label for="email"><b>Contact</b></label>
            <input type="text" class="form-control" placeholder="01XXXXXXXXX" name="contact" required>
            </div>
            </div>
            

            <div class="form-group">
            <label for="psw"><b>Password</b></label>
            <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
            </div>

            <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

            <button type="reset" class="btn btn-primary" value="reset">Reset</button>
            <input type="submit" name="submit" class="btn btn-primary" value="Sign Up">
            </form>
            </div>
            <div class="col-3"></div>
            </div>
                
        </div>
        
        
        <?php include "footer.php" ?>
    </div>
    
    <script src="js/bootstrap.min.js"></script>
</body>
</html>