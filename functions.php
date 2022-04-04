<?php include "connection.php"; ?>
   
<?php session_start(); ?>

<?php
function imageLink(){ 
    global $connection;
    $query = "SELECT pic FROM user WHERE id = {$_SESSION['id']}";
    $select_picture_query = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_array($select_picture_query)){
        $db_image       = $row['pic'];
    }
    echo $db_image;
}

function signatureLink(){
    global $connection;
    $query = "SELECT signature FROM user WHERE id = {$_SESSION['id']}";
    $select_signature_query = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_array($select_signature_query)){
        $db_signature       = $row['signature'];
    }
    echo $db_signature;
}

function tsignatureLink(){
    global $connection;
    $query = "SELECT signature FROM teacher WHERE id = {$_SESSION['tid']}";
    $select_signature_query = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_array($select_signature_query)){
        $db_signature       = $row['signature'];
    }
    echo $db_signature;
}

function getASWS(){
    global $term;
    global $sem;
    switch($_SESSION['term']){
        case 1: $term = "1st year";
            break;
        case 2: $term = "2nd year";
            break;
        case 3: $term = "3rd year";
            break;
        case 4: $term = "4th year";
            break;
    }
    switch($_SESSION['sem']){
        case 1: $sem = "odd sem.";
            break;
        case 2: $sem = "even sem.";
            break;
    }
    $year    = $_SESSION['series']+$_SESSION['term'];
    $session = ($year - 1)."-".$year;
    echo $session." / ".$term." ".$sem;
}


function getASWS_for_all(){
    global $term;
    global $sem;
    switch($db_term){
        case 1: $term = "1st year";
            break;
        case 2: $term = "2nd year";
            break;
        case 3: $term = "3rd year";
            break;
        case 4: $term = "4th year";
            break;
    }
    switch($db_sem){
        case 1: $sem = "odd sem.";
            break;
        case 2: $sem = "even sem.";
            break;
    }
    $year    = $db_series +$db_term;
    $session = ($year - 1)."-".$year;
    echo $session." / ".$term." ".$sem;
}



function getCredit(){
    global $connection;
    $query = "SELECT * FROM user WHERE id = {$_SESSION['id']};";
    $select_regno_query = mysqli_query($connection, $query);
    if(!$select_regno_query){
        die("QUERY Failed "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
    }

    while($row = mysqli_fetch_array($select_regno_query)){
        $db_credit       = $row['credit'];
    }
    echo $db_credit;
}

function getRegNo(){
    global $connection;
    $query = "SELECT * FROM user WHERE id = {$_SESSION['id']};";
    $select_regno_query = mysqli_query($connection, $query);
    if(!$select_regno_query){
        die("QUERY Failed "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
    }

    while($row = mysqli_fetch_array($select_regno_query)){
        $db_regno       = $row['regno'];
    }
    echo $db_regno;
    
}
function getEmail(){
    global $connection;
    $query = "SELECT * FROM user WHERE id = {$_SESSION['id']};";
    $select_email_query = mysqli_query($connection, $query);
    if(!$select_email_query){
        die("QUERY Failed "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
    }

    while($row = mysqli_fetch_array($select_email_query)){
        $db_email       = $row['email'];
    }
    echo $db_email;
    
}
function getSeries(){
    global $connection;
    $query = "SELECT * FROM user WHERE id = {$_SESSION['id']};";
    $select_series_query = mysqli_query($connection, $query);
    if(!$select_series_query){
        die("QUERY Failed "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
    }

    while($row = mysqli_fetch_array($select_series_query)){
        $db_series       = $row['series'];
    }
    echo $db_series;
    
}
function getCGPA(){
    global $connection;
    $query = "SELECT * FROM user WHERE id = {$_SESSION['id']};";
    $select_CGPA_query = mysqli_query($connection, $query);
    if(!$select_CGPA_query){
        die("QUERY Failed "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
    }

    while($row = mysqli_fetch_array($select_CGPA_query)){
        $db_CGPA      = $row['cgpa'];
    }
    echo $db_CGPA;
    
}
function getContact(){
    global $connection;
    $query = "SELECT * FROM user WHERE id = {$_SESSION['id']};";
    $select_contact_query = mysqli_query($connection, $query);
    if(!$select_contact_query){
        die("QUERY Failed "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
    }

    while($row = mysqli_fetch_array($select_contact_query)){
        $db_contact       = $row['contact'];
    }
    echo $db_contact;
    
}
function getyrsm(){
    global $connection;
    $query = "SELECT * FROM user WHERE id = {$_SESSION['id']};";
    $select_yrsm_query = mysqli_query($connection, $query);
    if(!$select_yrsm_query){
        die("QUERY Failed "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
    }

    while($row = mysqli_fetch_array($select_yrsm_query)){
        $db_term    = $row['term'];
        $db_sem     = $row['sem'];
    }
    echo $db_term."/".$db_sem;
    
}
function getSection(){
    global $connection;
    $query = "SELECT * FROM user WHERE id = {$_SESSION['id']};";
    $select_section_query = mysqli_query($connection, $query);
    if(!$select_section_query){
        die("QUERY Failed "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
    }

    while($row = mysqli_fetch_array($select_section_query)){
        $db_section       = $row['section'];
    }
    echo $db_section;
    
}
function getDepartment(){
    global $connection;
    $query = "SELECT * FROM user WHERE id = {$_SESSION['id']};";
    $select_department_query = mysqli_query($connection, $query);
    if(!$select_department_query){
        die("QUERY Failed "."<br>".mysqli_error($connection)."<br>".mysqli_errno($connection));
    }

    while($row = mysqli_fetch_array($select_department_query)){
        $db_department       = $row['department'];
    }
    echo $db_department;   
}

?>