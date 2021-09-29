<?php
session_start();
unset($_SESSION['uuid']);
header('Location:index.php');
?>