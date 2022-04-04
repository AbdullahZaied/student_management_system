<?php 
$connection = mysqli_connect('localhost', 'root', '', 'website');
if(!$connection){
    die("Connection Failed ").mysqli_error($connection);
}
?>