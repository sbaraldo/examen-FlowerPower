<?php 
    require 'header.php';
    include 'nav.php';

    if(isset($message)) {
        foreach($message as $message) {
            echo '<span class="message">'.$message.'</span>';
        }
    } 
?>

    <!-- form -->
    <div class="container">
        <div class="gegevens-form-container">
            <?php
                $select = mysqli_query($conn, "SELECT * FROM users WHERE iduser = ''");
                while($row = mysqli_fetch_assoc($select)) 
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
                            <input type="date" placeholder="geboortedatum" value="<?php echo $row['geboortedatum'] ?>" name="geboortedatum" class="box">
                            <input type="text" placeholder="email" value="<?php echo $row['email'] ?>" name="email" class="box">
                            <input type="text" placeholder="wachtwoord" value="<?php echo $row['wachtwoord'] ?>" name="wachtwoord" class="box">
                            <input type="submit" class="knop" name="user_gegevens_bewerken" value="Gegevens bewerken">
                            <a href="../user/index.php" class="knop">Ga terug</a>
                        </form>
                    <?php
                }
            ?>
        </div>
    </div>
</body>
</html>