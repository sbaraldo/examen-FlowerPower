<?php 
session_start();
include 'db.php';

//functie om als admin/medewerker in te loggen door POST methode//
if(isset($_POST['login_admin_knop'])) {

    // declareren en initialiseren en daarna email en wachtwoord
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    $login_admin = "SELECT * FROM adminuser WHERE email = '$email' AND wachtwoord = '$wachtwoord'";
    $admin_run = mysqli_query($conn, $login_admin);
    
    //checken voor gegevens//
    if(mysqli_num_rows($admin_run) > 0) 
    {
        // $admin_run wordt nieuwe variabelen $admin_data//
        foreach($admin_run as $admin_data)
        {
            // wordt vanuit de database opgeroepen//
            $admin_id = $admin_data['idadmin'];
            $admin_naam = $admin_data['voornaam']. '' .$admin_data['tussenvoegsel']. '' .$admin_data['achternaam'];
            $admin_email = $admin_data['email'];
            $admin_rol = $admin_data['rol'];
        }

        //initialiseren en krijgt de waardes van de database//
        $_SESSION['admin_auth'] = true;
        $_SESSION['admin_rol'] = $admin_rol;
        $_SESSION['admin_user'] = [
            'admin_id' => $admin_id,
            'admin_naam' => $admin_naam,
            'admin_email' => $admin_email, 
        ];

        // als de admin/medewerker rol 1 heeft wordt doorgestuurd naar admin/dashboard en als het rol 2 heeft naar medewerker/dashboard //
        if($_SESSION['admin_rol'] == '1')
        {
            header('Location: ../admin/dashboard.php?Welkom-admin');
            exit(0);
        } elseif($_SESSION['admin_rol'] == '2') 
        {
            header('Location: ../medewerker/dashboard.php?Welkom-medewerker');
            exit(0);
        }
    } else 
    {
        header("Location: ../admin/admin_login.php?Ongeldig-email-of-wachtwoord");
        exit(0);
    }
}