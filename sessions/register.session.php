<?php
require ('db.php');

 //functie om te registreren//

if(isset($_POST['registreer_knop'])) 
{

    $vn = mysqli_real_escape_string($conn, $_POST['voornaam']);
    $tv = mysqli_real_escape_string($conn, $_POST['tussenvoegsel']);
    $an = mysqli_real_escape_string($conn, $_POST['achternaam']);
    $ad = mysqli_real_escape_string($conn, $_POST['adres']);
    $hn = mysqli_real_escape_string($conn, $_POST['huisnummer']);
    $pc = mysqli_real_escape_string($conn, $_POST['postcode']);
    $pl = mysqli_real_escape_string($conn, $_POST['plaats']);
    $tel = mysqli_real_escape_string($conn, $_POST['telefoon']);
    $gd = mysqli_real_escape_string($conn, $_POST['geboortedatum']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $ww = mysqli_real_escape_string($conn, $_POST['wachtwoord']);
    $ww_bv = mysqli_real_escape_string($conn, $_POST['bevestig_wachtwoord']);
    

    if($ww == $ww_bv)
    {
        $check_email = "SELECT email FROM user WHERE email='$email'";
        $check_mail_run = mysqli_query($conn, $check_email);

        if(mysqli_num_rows($check_mail_run) > 0) 
        {
            header('Location: register.php?Email bestaat al');
            exit();
        }
        else 
        {
            $query = "INSERT INTO users (voornaam, tussenvoegsel, achternaam, adres, huisnummer, postcode, plaats, telefoon, geboortedatum, email, wachtwoord, wachtwoordbv)
             VALUES ('$vn', '$tv', '$an', '$ad', '$hn', '$pc', '$pl', '$tel', '$gd', '$email', '$ww', '$ww_bv')";
            $query_run = mysqli_query($conn, $query);

            if($query_run) 
            {
                header('Location: ../user/login.php?Registreren is gelukt');
                exit();
            }
            else 
            {
                header('Location: ../user/register.php?Ging iets fout');
                exit();
            }
        }
    }
    else 
    {
        header('Location: ../user/register.php?Wachtwoord en Bevestig wachtwoord zijn niet hetzelfde');
        exit();
    }
   
}