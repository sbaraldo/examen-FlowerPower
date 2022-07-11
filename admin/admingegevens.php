<?php 
require '../user/header.php';
include 'dashnav.php';

//Alleen admin met rol 1 heeft toegang//
if(!$_SESSION['admin_rol'] == '1')
{
    header('Location: dashboard.php?Alleen-admin-heeft-toegang');
    exit(0);
}

// functie artikelen toevoegen door POST Methode en declareren en initialiseren//
if(isset($_POST['user_toevoegen'])) {
    $voornaam = $_POST['voornaam'];
    $tussenvoegsel = $_POST['tussenvoegsel'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $rol = $_POST['rol'];

    //kijken als het empty is, als het empty is krijg je een bericht en anders query insert into om te toevoegen//
    if(empty($voornaam) || empty($achternaam) || empty($email) || empty($wachtwoord) || empty($rol)) {
        $message[] = 'Vul alles in';
    } 
    else {
        $query_insert = mysqli_query($conn, "INSERT INTO adminuser (voornaam, tussenvoegsel , achternaam, email, wachtwoord, rol)
        VALUES ('$voornaam', '$tussenvoegsel', '$achternaam', '$email', '$wachtwoord', '$rol')");
        
        
        if($query_insert) {
            $message[] = 'User toegevoegd gelukt!';
        }
        else {
            $message[] = 'Kan niet toevoegen';
        }

    } 
}

//functie verwijder gegevens met GET methode, kijken is het leeg of gedeclareerd is dan query delete om idadmin te verwijderen//
if(isset($_GET['verwijder'])) {

    $idadmin = $_GET['verwijder'];
    mysqli_query($conn, "DELETE FROM adminuser WHERE idadmin = $idadmin");
    header('location: ../admin/admingegevens.php');
}
?>

   
<!-- formulier om medewerker toevoegen -->
<div class="container">
    <div class="gegevens-form-container">
        <?php 
            if(isset($message)) 
            {
                foreach($message as $message) 
                {
                echo '<span class="message">'.$message.'</span>';
                }
            }
        ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <h3>User toevoegen</h3>
            <input type="text" placeholder="Voornaam" name="voornaam" class="box">
            <input type="text" placeholder="Tussenvoegsel" name="tussenvoegsel" class="box">
            <input type="text" placeholder="Achternaam" name="achternaam" class="box">
            <input type="text" placeholder="Email" name="email" class="box">
            <input type="text" placeholder="Wachtwoord" name="wachtwoord" class="box">
            <input type="text" placeholder="Rol" name="rol" class="box">
            <input type="submit" class="knop" name="user_toevoegen" value="User toevoegen">
        </form>
    </div>


        <!-- tabel om toegevoegde medewerkers te laten zien -->
    <div class="toon-gegevens">
        <table class="toon-gegevens-table">
            <thead>
                <tr>
                    <th>Voornaam</th>
                    <th>Tussenvoegsel</th>
                    <th>Achternaam</th>
                    <th>Email</th>
                    <th>Wachtwoord</th>
                    <th>Rol</th>
                    <th colspan="2">Actie</th>
                </tr>
            </thead>
            <?php
            // selecteert de adminuser (medewerkers) waarvan alleen de gegevens met rol en sorteer op ascending (oplopend) haalt gegevens van de database//
                $select_admin = mysqli_query($conn, "SELECT * FROM adminuser WHERE rol ORDER BY rol ASC ");
                if(mysqli_num_rows($select_admin) > 0) 
                {
                    while($row = mysqli_fetch_assoc($select_admin)) 
                    {
                        ?>
                            <tr>
                                <td><?php echo $row['voornaam']; ?></td>
                                <td><?php echo $row['tussenvoegsel']; ?></td>
                                <td><?php echo $row['achternaam']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['wachtwoord']; ?></td>
                                <td><?php echo $row['rol']; ?></td>
                                <td>
                                    <a href="../admin/admingegevens_bewerken.php?bewerk=<?php echo $row['idadmin']?>"> 
                                    <button class="bewerken_knop">Bewerken</button></a>
                                    <a href="../admin/admingegevens.php?verwijder=<?php echo $row['idadmin']?>"> 
                                    <button class="verwijder_knop">Verwijder</button></a>
                                </td>
                            </tr>
                        <?php
                    }
                }
            ?>               
        </table>
    </div>  
</div>

<?php
include '../user/footer.php';
?>