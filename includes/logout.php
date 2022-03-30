<?php ob_start(); ?>
<?php session_start(); ?>

<?php 

$_SESSION['session_user_name'] = null;
$_SESSION['session_user_first_name'] = null;
$_SESSION['session_user_last_name'] = null;
$_SESSION['session_user_role'] = null; 

header("Location: ../index.php");

?>