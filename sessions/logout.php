<?php 
session_start();

if(isset($_POST['logout'])) {
    unset($_SESSION['authentication']);
    unset($_SESSION['authenticationRole']);
    unset($_SESSION['authenticationUser']);

    header('Location: ../user/index.php?you-are-logged-out');
    exit(0);
}