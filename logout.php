<?php
session_start();
session_destroy();
unset($_SESSION['username']);
$_SESSION['message']="Thanks For Visiting";
header("location:index.php");
?>