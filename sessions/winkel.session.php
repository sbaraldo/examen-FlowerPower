<?php
require_once 'db.php';


if(isset($_POST['winkel_btn'])) 
{
    $winkel_adres = mysqli_real_escape_string($conn, $_POST['winkel_adres']);
    $winkel_email = mysqli_real_escape_string($conn, $_POST['winkel_email']);
    $winkel_huis_nr = mysqli_real_escape_string($conn, $_POST['winkel_huis_nr']);
    $winkel_plaats = mysqli_real_escape_string($conn, $_POST['winkel_plaats']);
    $winkel_postcode = mysqli_real_escape_string($conn, $_POST['winkel_postcode']);
    $winkel_telefoon = mysqli_real_escape_string($conn, $_POST['winkel_tel_nr']);

    if(empty($winkel_adres) || empty($winkel_email) || empty($winkel_huis_nr) || empty($winkel_plaats) 
    || empty($winkel_postcode) || empty($winkel_telefoon))
    {
        header("Location: ../admin/form.winkel.php?EMPTY-FIELDS");
        exit();
    } else 
    {
        $sql = mysqli_query($conn, "INSERT INTO winkel (winkeladres, winkelemail, winkelhuisnummer, 
        winkelplaats, winkelpostcode, winkeltelefoon) VALUES ('$winkel_adres', '$winkel_email', '$winkel_huis_nr', 
        '$winkel_plaats', '$winkel_postcode', '$winkel_telefoon')") or mysqli_error($conn);

        if($sql)
        {
            header("Location: ../admin/form.winkel.php?SUCCES");
            exit();
        } else 
        {
            header("Location: ../admin/form.winkel.php?FAIL");
            exit();
        }
    }    
}
