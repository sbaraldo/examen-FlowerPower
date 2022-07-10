<?php
session_start();
include 'db.php';

//Functie om als gebruiker in te loggen door POST methode//
if(isset($_POST['login_knop'])) {

    //Declareren en initialiseren en daarna email en wachtwoord selecteren//
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    $login_user = "SELECT * FROM users WHERE email='$email' AND wachtwoord='$wachtwoord'";
    $login_run = mysqli_query($conn, $login_user);

    //checken voor gegevens//
    if(mysqli_num_rows($login_run) > 0)
    {
        //Login_run wordt nieuwe variabelen $user_data//
        foreach($login_run as $user_data)
        {
            //Wordt vanuit de database geroepen//
            $user_id = $user_data['iduser'];
            $user_naam = $user_data['voornaam']. ''.$user_data['tussenvoegsel']. '' .$user_data['achternaam'];
            $user_email = $user_data['email'];
            $rol = $user_data['rol'];
        }

        //Initialiseren en krijgt de waardes van de database//
        $_SESSION['authentication'] = true;
        $_SESSION['authenticationRole'] = "$rol";
        $_SESSION['authenticationUser'] = [
            'userID'=>$user_id,
            'userName'=>$user_naam,
            'userEmail'=>$user_email,
        ];

        //Als de gebruiker rol 0 heeft wordt je doorgestuurd naar user/index.php//
        if($_SESSION['authenticationRole'] == '0' || $_SESSION['authenticationRole'] == NULL) 
        {
            header("Location: ../user/index.php?Welkom-user");
            exit(0);
        }
    }
    else 
    {
        header("Location: ../user/login.php?Ongeldig-email-of-wachtwoord");
        exit(0);
    }
}