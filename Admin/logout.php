<?php
session_start();

session_destroy();
header('location:/city-taxi/admin-login.php');
?>