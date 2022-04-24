<?php
session_start();
unset($_SESSION['admins']);
header('Location:login.php');
?>