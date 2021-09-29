<?php
session_start();
unset($_SESSION['uid']);
unset($_SESSION['cart']);
header('Location:index.php');
?>