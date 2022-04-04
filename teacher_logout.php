<?php session_start(); ?>
<?php
    $_SESSION['tid']         = null;
    $_SESSION['tname']       = null;
    $_SESSION['tdepartment'] = null;
    session_destroy();
    header("Location: signin.php");
?>


