<?php 
require '../user/header.php';
include 'dashnav.php';

if(isset($_POST['user_toevoegen'])) {
    $voornaam = $_POST['voornaam'];
    $tussenvoegsel = $_POST['tussenvoegsel'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $rol = $_POST['rol'];

    
    if(empty($voornaam) || empty($tussenvoegsel) || empty($achternaam) || empty($email) || empty($wachtwoord) || empty($rol)) {
        $message[] = 'Vul alles in';
    } 
    else {
        $query = mysqli_query($conn, "INSERT INTO users (voornaam, tussenvoegsel , achternaam, email, wachtwoord, rol)
        VALUES ('$voornaam', '$tussenvoegsel', '$achternaam', '$email', '$wachtwoord', '$rol')");
        
        
        if($query) {
            $message[] = 'User toegevoegd gelukt!';
        }
        else {
            $message[] = 'Kan niet toevoegen';
        }

    } 
}

//functie product verwijderen//
if(isset($_GET['verwijder'])) {

    $iduser = $_GET['verwijder'];
    mysqli_query($conn, "DELETE FROM users WHERE iduser = $iduser");
    header('location: ../admin/admingegevens.php');
}
?>

   

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
            <input type="email" placeholder="Email" name="email" class="box">
            <input type="password" placeholder="Wachtwoord" name="wachtwoord" class="box">
            <input type="text" placeholder="Rol" name="rol" class="box">
            <input type="submit" class="knop" name="user_toevoegen" value="User toevoegen">
        </form>
    </div>



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
                $select = mysqli_query($conn, "SELECT * FROM users");
                if(mysqli_num_rows($select) > 0) 
                {
                    while($row = mysqli_fetch_assoc($select)) 
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
                                    <a href="../admin/admingegevens_bewerken.php?bewerk=<?php echo $row['iduser']?>"> 
                                    <button class="bewerken_knop">Bewerken</button></a>
                                    <a href="../admin/admingegevens.php?verwijder=<?php echo $row['iduser']?>"> 
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