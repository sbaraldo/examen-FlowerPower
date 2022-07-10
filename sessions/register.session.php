<?php
require ('db.php');

 //functie om te registreren door POST methode en declareren en initialiseren//

if(isset($_POST['registreer_knop'])) 
{

    $vn = $_POST['voornaam'];
    $tv = $_POST['tussenvoegsel'];
    $an = $_POST['achternaam'];
    $ad = $_POST['adres'];
    $hn = $_POST['huisnummer'];
    $pc = $_POST['postcode'];
    $pl = $_POST['plaats'];
    $tel = $_POST['telefoon'];
    $gd = $_POST['geboortedatum'];
    $email = $_POST['email'];
    $ww = $_POST['wachtwoord'];
    $ww_bv = $_POST['bevestig_wachtwoord'];
    
    //Bevestig wachtwoord heeft zelfde waarde als wachtwoord//
    if($ww == $ww_bv)
    {
        //je selecteert de email van de user en checkt of de email hetzelde is//
        $check_email = "SELECT email FROM user WHERE email='$email'";
        $check_mail_run = mysqli_query($conn, $check_email);

        //checkt of de email al bestaat//
        if(mysqli_num_rows($check_mail_run) > 0) 
        {
            header('Location: register.php?Email-bestaat-al');
            exit();
        }
        else 
        {
            //Bestaat de email niet dan voeg je hem toe in de database met INSERT INTO//
            $query_insert = "INSERT INTO users (voornaam, tussenvoegsel, achternaam, adres, huisnummer, postcode, plaats, telefoon, geboortedatum, email, wachtwoord, wachtwoordbv)
             VALUES ('$vn', '$tv', '$an', '$ad', '$hn', '$pc', '$pl', '$tel', '$gd', '$email', '$ww', '$ww_bv')";
            $query_run = mysqli_query($conn, $query_insert);

            //Als de query gelukt is ben je geregistreert anders niet//
            if($query_run) 
            {
                header('Location: ../user/login.php?Registreren-is-gelukt');
                exit();
            }
            else 
            {
                header('Location: ../user/register.php?Ging-iets-fout');
                exit();
            }
        }
    }
    else 
    {
        header('Location: ../user/register.php?Wachtwoord-en-Bevestig-wachtwoord-zijn-niet-hetzelfde');
        exit();
    }
   
}