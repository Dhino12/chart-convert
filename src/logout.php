<?php 
session_start();

include 'script/functions.php';
$username = $_SESSION['username'];
$level = $_SESSION['level'];

$queryUpdateStatus = "UPDATE $level SET status='unactive' WHERE username='$username'";
$result = query($queryUpdateStatus, '');

session_destroy();
$_SESSION = [];
header("Location: ../login.php");
?>