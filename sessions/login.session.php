<?php
session_start();
include 'db.php';

if(isset($_POST['login_knop'])) {

$email = mysqli_real_escape_string($conn, $_POST['email']);
$ww = mysqli_real_escape_string($conn, $_POST['wachtwoord']);

$login_q = "SELECT * FROM users WHERE email='$email' AND wachtwoord='$ww'";
$login_run = mysqli_query($conn, $login_q);

if(mysqli_num_rows($login_run) > 0)
{
    foreach($login_run as $userData)
    {
        $userID = $userData['iduser'];
        $userName = $userData['voornaam']. ''.$userData['tussenvoegsel']. '' .$userData['achternaam'];
        $userEmail = $userData['email'];
        $rol = $userData['rol'];
    }

    $_SESSION['authentication'] = true;
    $_SESSION['authenticationRole'] = "$rol";
    $_SESSION['authenticationUser'] = [
        'userID'=>$userID,
        'userName'=>$userName,
        'userEmail'=>$userEmail,
    ];

    if($_SESSION['authenticationRole'] == '1' || $_SESSION['authenticationRole'] == '2')
    {
        header("Location: ../admin/dashboard.php");
        exit(0);
    }
    elseif($_SESSION['authenticationRole'] == '0' || $_SESSION['authenticationRole'] == NULL) 
    {
        header("Location: ../user/index.php");
        exit(0);
    }
}
else 
{
    header("Location: ../user/login.php?invalid-mail-or-pwd");
    exit(0);
}

}