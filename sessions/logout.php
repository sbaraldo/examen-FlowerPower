<?php 
session_start();

// Je wordt uitgelogd als je op logout klikt met POST methode voor user en admin/medewerker//
if(isset($_POST['logout'])) {
    unset($_SESSION['authentication']);
    unset($_SESSION['authenticationRole']);
    unset($_SESSION['authenticationUser']);

    unset($_SESSION['admin_auth']);
    unset($_SESSION['admin_rol']);
    unset($_SESSION['admin_user']);

    header('Location: ../user/index.php?Je-bent-uitgelogd');
    exit(0);
}