<?php
session_start();
require_once '../sessions/db.php';

$_GET['gegevensbewerk'];

if(isset($_POST['user_gegevens_bewerken'])) {
    $voornaam = $_POST['voornaam'];
    $tussenvoegsel = $_POST['tussenvoegsel'];
    $achternaam = $_POST['achternaam'];
    $adres = $_POST['adres'];
    $huisnummer = $_POST['huisnummer'];
    $postcode = $_POST['postcode'];
    $plaats = $_POST['plaats'];
    $telefoon = $_POST['telefoon'];
    $geboortedatum = $_POST['geboortedatum'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    

    if(empty($voornaam) ||  empty($tussenvoegsel) ||  empty($achternaam) ||  empty($adres) ||  empty($huisnummer)
        ||  empty($postcode) || empty($plaats) ||  empty($telefoon) ||  empty($geboortedatum) ||  empty($email)  ||  empty($wachtwoord)) {
        $message[] = 'Vul alles in';
    }  
    else {
        $query = "UPDATE users SET voornaam = '$voornaam', tussenvoegsel = '$tussenvoegsel', adres = '$adres', huisnummer = '$huisnummer',
            postcode = '$postcode', plaats = '$plaats', telefoon = '$telefoon', geboortedatum = '$geboortedatum', email = '$email', wachtwoord = '$wachtwoord' 
        WHERE iduser = ";
        $query_run = mysqli_query($conn,$query);

        if($query) {
            $message[] = 'Gegevens bewerkt gelukt!';
        }
        else {
            $message[] = 'Kan niet bewerken';
        }

    } 
}