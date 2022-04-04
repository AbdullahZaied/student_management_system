<?php session_start(); ?>
<?php
    $_SESSION['id']         = null;
    $_SESSION['name']       = null;
    $_SESSION['regno']      = null;
    $_SESSION['department'] = null;
    $_SESSION['series']     = null;
    $_SESSION['term']       = null;
    $_SESSION['sem']        = null;
    session_destroy();
    header("Location: signin.php");
?>