<?php
require '../user/header.php';

//Alleen als je ingelogd bent als gebruiker heb je toegang//
if(!$_SESSION['authentication']) 
    {

        header('Location: index.php?Je-moet-inloggen');
        exit();
    }

$get_id_user = $_SESSION['authenticationUser']['userID'];

//functie gegevens bewerken/updaten van de gebruiker door POST methode en declareren en initialiseren//
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
    
    // Kijken als het empty is, als het empty is krijg je een bericht en anders query update om te updaten//
    if(empty($voornaam) ||  empty($achternaam) ||  empty($adres) ||  empty($huisnummer)
        ||  empty($postcode) || empty($plaats) ||  empty($telefoon) ||  empty($geboortedatum) ||  empty($email)  ||  empty($wachtwoord)) {
        $message[] = 'Vul alles in';
    }  
    else {
        $query_update = "UPDATE users SET voornaam = '$voornaam', tussenvoegsel = '$tussenvoegsel', adres = '$adres', huisnummer = '$huisnummer',
            postcode = '$postcode', plaats = '$plaats', telefoon = '$telefoon', geboortedatum = '$geboortedatum', email = '$email', wachtwoord = '$wachtwoord' 
        WHERE iduser = $get_id_user";
        $query_run = mysqli_query($conn,$query_update);

        if($query_update) {
            $message[] = 'Gegevens bewerkt gelukt!';
        }
        else {
            $message[] = 'Kan niet bewerken';
        }

    }
}

?>

    <!-- Gegevens van de gebruiker formulier -->
    <div class="container">
        <div class="gegevens-form-container">
            <?php
            
            if(isset($message)) {
                foreach($message as $message) {
                    echo '<span class="message">'.$message.'</span>';
                }
            } 

            //Selecteert de gebruiker die ingelogd is en haalt gegevens op van de database//
            $select_user = mysqli_query($conn, "SELECT * FROM users WHERE iduser = '$get_id_user'");
            if(mysqli_num_rows($select_user) > 0)
            {
                while($row = mysqli_fetch_assoc($select_user)) 
                {
                    ?>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                            <h3>Bewerk gegevens</h3>
                            <input type="text" placeholder="voornaam" value="<?php echo $row['voornaam'] ?>" name="voornaam" class="box">
                            <input type="text" placeholder="tussenvoegsel" value="<?php echo $row['tussenvoegsel'] ?>" name="tussenvoegsel" class="box">
                            <input type="text" placeholder="achternaam" value="<?php echo $row['achternaam'] ?>" name="achternaam" class="box">
                            <input type="text" placeholder="adres" value="<?php echo $row['adres'] ?>" name="adres" class="box">
                            <input type="text" placeholder="huisnummer" value="<?php echo $row['huisnummer'] ?>" name="huisnummer" class="box">
                            <input type="text" placeholder="postcode" value="<?php echo $row['postcode'] ?>" name="postcode" class="box">
                            <input type="text" placeholder="plaats" value="<?php echo $row['plaats'] ?>" name="plaats" class="box">
                            <input type="text" placeholder="telefoon" value="<?php echo $row['telefoon'] ?>" name="telefoon" class="box">
                            <input type="date" placeholder="geboortedatum" value="<?php echo $row['geboortedatum'] ?>" name="geboortedatum" class="box">
                            <input type="text" placeholder="email" value="<?php echo $row['email'] ?>" name="email" class="box">
                            <input type="text" placeholder="wachtwoord" value="<?php echo $row['wachtwoord'] ?>" name="wachtwoord" class="box">
                            <input type="submit" class="knop" name="user_gegevens_bewerken" value="Gegevens bewerken">
                            <a href="../user/index.php" class="knop">Ga terug</a>
                        </form>
                    <?php
                }
            }
        ?>
    </div>
</div>