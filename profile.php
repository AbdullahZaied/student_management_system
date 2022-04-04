<?php include "connection.php"; ?>
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
    <title><?php echo "Profile - ".$_SESSION['name'] ?></title>
</head>
<body>  
    <div style="position: relative; min-height: 100vh;">
        <?php include "header.php" ?>
     <div class="wrapper" style="padding-top:15px; padding-bottom: -80px;">
      <div class="row" style="padding-bottom: 100px; margin-bottom: 0px;">
         <div class="col-lg-2"></div>
         <div class="col-lg-8">
             <div class="card" style="width: 50rem; height: 45rem">
        <div class="card-header">
            <h2 style="font-style: oblique; font-weight: bold; text-align: center">Student Information</h2>
        </div>
        <div class="card-body">
           <div class="row">
            <div class="col-lg-4">
                <div class="card">
                <div class="card-body">
                    <div style="text-align: center; margin: 0px 0 12px 0;">
                        <img src="<?php imageLink(); ?>" alt="Avatar" style="width:100%; border-color: #a3c2c2; border-width: 3px; border-style: solid">
                    </div>
                    <div style="text-align: center; margin: 0; padding-left:-50px;">
                        <img src="<?php signatureLink(); ?>" alt="signature" style="width:200px; height: 80px;">
                    </div>
                    <form method="post" enctype="multipart/form-data" action="store_image.php">
                        <div class="custom-file" style="margin-bottom:3px">
                          <input type="file" name="file" class="custom-file-input" id="customFile">
                          <label class="custom-file-label" for="customFile">Add Photo</label>
                        </div>
                        <div class="custom-file">
                          <input type="file" name="file1" class="custom-file-input" id="customFile">
                          <label class="custom-file-label" for="customFile">Add Signature</label>
                        </div>
                        <hr style="margin: 5px 0 5px 0">
                        <button style="margin: 0 0 0 57px" type="submit" name="change" class="btn btn-primary">Change</button>
                    </form>
                </div>
                <div class="card-footer">
                    <small>You should upload your photo and signature just for once.</small>
                </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                <div class="card-body">
                <table class="table">
                    <tbody>
                      <tr>
                        <td>Name:</td>
                        <td><?php echo $_SESSION['name'] ?></td>
                      </tr>
                      <tr>
                        <td>Student ID:</td>
                        <td><?php echo $_SESSION['id'] ?></td>
                      </tr>
                      <tr>
                        <td>Registration No:</td>
                        <td><?php getRegNo(); ?></td>
                      </tr>
                      <tr>
                        <td>Department:</td>
                        <td><?php getDepartment(); ?></td>
                      </tr>
                      <tr>
                        <td>Series:</td>
                        <td><?php getSeries(); ?></td>
                      </tr>
                      <tr>
                        <td>Section:</td>
                        <td><?php getSection(); ?></td>
                      </tr>
                      <tr>
                        <td>Year/Sem:</td>
                        <td><?php getyrsm(); ?></td>
                      </tr>
                      <tr>
                        <td>CGPA:</td>
                        <td><?php getCGPA(); ?></td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td><?php getEmail(); ?></td>
                      </tr>
                      <tr>
                        <td>Contact:</td>
                        <td><?php getContact(); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                </div>
            </div>
           </div>
        </div>
    </div>
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