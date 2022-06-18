<?php 
require '../user/header.php';
include 'dashnav.php';

$iduser = $_GET['bewerk'];

if(isset($_POST['gegevens_bewerken'])) {
    $voornaam = $_POST['voornaam'];
    $tussenvoegsel = $_POST['tussenvoegsel'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $rol = $_POST['rol'];
    

    if(empty($voornaam) ||  empty($achternaam) || empty($email) || empty($wachtwoord) || empty($rol)) {
        $message[] = 'Vul alles in';
    }  
    else {
        $query = "UPDATE users SET voornaam = '$voornaam', tussenvoegsel = '$tussenvoegsel', achternaam = '$achternaam', email = '$email', wachtwoord = '$wachtwoord', rol = '$rol'
        WHERE iduser = $iduser";
        $query_run = mysqli_query($conn,$query);

        if($query) {
            $message[] = 'Gegevens bewerkt gelukt!';
        }
        else {
            $message[] = 'Kan niet bewerken';
        }

    } 
}
?>

<div class="container">
    <div class="gegevens-form-container">
        <?php
            if(isset($message)) {
                foreach($message as $message) {
                    echo '<span class="message">'.$message.'</span>';
                }
            } 

            $select = mysqli_query($conn, "SELECT * FROM users WHERE iduser = '$iduser'");
            if(mysqli_num_rows($select) > 0)
            {
                while($row = mysqli_fetch_assoc($select))
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

                            <input type="submit" class="knop" name="gegevens_bewerken" value="Gegevens bewerken">
                            <a href="../admin/admingegevens.php" class="knop">Ga terug</a>
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