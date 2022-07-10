<?php 
require '../user/header.php';
include 'dashnav.php';

$idadmin = $_GET['bewerk'];

//functie gegevens bewerken/updaten van de medewerkers/admin door POST methode en declareren en initialiseren//
if(isset($_POST['gegevens_bewerken'])) {
    $voornaam = $_POST['voornaam'];
    $tussenvoegsel = $_POST['tussenvoegsel'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $rol = $_POST['rol'];
    
    //kijken als het empty is, als het empty is krijg je een bericht en anders query update om te updaten//
    if(empty($voornaam) ||  empty($achternaam) || empty($email) || empty($wachtwoord) || empty($rol)) {
        $message[] = 'Vul alles in';
    }  
    else {
        $query_update = "UPDATE adminuser SET voornaam = '$voornaam', tussenvoegsel = '$tussenvoegsel', achternaam = '$achternaam', email = '$email', wachtwoord = '$wachtwoord', rol = '$rol'
        WHERE idadmin = $idadmin";
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

<!-- gegevens van de medewerker formulier -->
<div class="container">
    <div class="gegevens-form-container">
        <?php
            if(isset($message)) {
                foreach($message as $message) {
                    echo '<span class="message">'.$message.'</span>';
                }
            } 

            //selecteert de adminuser (medewerkers/ 1 admin) en haalt gegevens op van de database//
            $select_admin = mysqli_query($conn, "SELECT * FROM adminuser WHERE idadmin = '$idadmin'");
            if(mysqli_num_rows($select_admin) > 0)
            {
                while($row = mysqli_fetch_assoc($select_admin))
                {
                    ?>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                            <h3>Bewerk gegevens</h3>
                            <input type="text" placeholder="voornaam" value="<?php echo $row['voornaam'] ?>" name="voornaam" class="box">
                            <input type="text" placeholder="tussenvoegsel" value="<?php echo $row['tussenvoegsel'] ?>" name="tussenvoegsel" class="box">
                            <input type="text" placeholder="achternaam" value="<?php echo $row['achternaam'] ?>" name="achternaam" class="box">
                            <input type="text" placeholder="email" value="<?php echo $row['email'] ?>" name="email" class="box">
                            <input type="text" placeholder="wachtwoord" value="<?php echo $row['wachtwoord'] ?>" name="wachtwoord" class="box">
                            <input type="text" placeholder="rol" value="<?php echo $row['rol'] ?>" name="rol" class="box">

                            <input type="submit" class="knop_gegevens_bewerken" name="gegevens_bewerken" value="Gegevens bewerken">
                            <a href="../admin/admingegevens.php" class="knop_gegevens_bewerken">Ga terug</a>
                        </form>
                    <?php
                }
            }
        ?>
    </div>
</div>

<?php 
include '../user/footer.php';
?>