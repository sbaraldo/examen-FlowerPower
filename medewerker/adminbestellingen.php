<?php 
    require '../user/header.php';
    include 'dashnav.php';

    //Update bestelling met POST, kijken is het leeg of gedeclareerd is dan query update// 
    if(isset($_POST['update_bestelling'])) {
        $idbestelling = $_POST['bestelling_id'];
        $update_betaling = $_POST['update_betaling'];
        mysqli_query($conn, "UPDATE bestelling SET status = '$update_betaling' WHERE idbestelling = $idbestelling") or die ('error');
        header('Location: ../medewerker/adminbestellingen.php?Bestelling-status-updated');    
    }

    //Verwijder bestelling met GET methode, kijken is het leeg of gedeclareerd is dan query delete// 
    if(isset($_GET['verwijder'])) {
        $delete_id = $_GET['verwijder'];
        mysqli_query($conn, "DELETE FROM bestelling WHERE idbestelling = '$delete_id'") or die('error');
        header('Location: ../medewerker/adminbestellingen.php');
    }
?>

<section class="bestellingen">

    <div class="box-container">

        <?php

        // gegevens selecteren van bestelling en dan ophalen van de database, Kolom van andere tabel gegevens wordt naar deze tabel erin gegooid//
        $select_bestelling = mysqli_query($conn, "SELECT * FROM bestelling
        INNER JOIN users ON bestelling.userid = users.iduser");
        if(mysqli_num_rows($select_bestelling) > 0) {
            while($fetch_bestelling = mysqli_fetch_assoc($select_bestelling)) {
              
                
        ?>

        <!-- toon gegevens van de bestelling -->
        <div class="bestelling-box">

            <p> Voornaam: <?php echo $fetch_bestelling['voornaam']; ?></p>
            <p> Tussenvoegsel: <?php echo $fetch_bestelling['tussenvoegsel']; ?></p>
            <p> Achternaam: <?php echo $fetch_bestelling['achternaam']; ?></p>
            <p> Adres: <?php echo $fetch_bestelling['adres']; ?></p>
            <p> Huisnummer: <?php echo $fetch_bestelling['huisnummer']; ?></p>
            <p> Postcode: <?php echo $fetch_bestelling['postcode']; ?></p>
            <p> Plaats: <?php echo $fetch_bestelling['plaats']; ?></p>
            <p> Telefoon: <?php echo $fetch_bestelling['telefoon']; ?></p>
            <p> Geboortedatum: <?php echo $fetch_bestelling['geboortedatum']; ?></p>
            <p> Email: <?php echo $fetch_bestelling['email']; ?></p>
            <p> Totaal product: <?php echo $fetch_bestelling['totaalproduct']; ?></p>
            <p> Totaal prijs: € <?php echo $fetch_bestelling['totaalprijs']; ?></p>
            <form action="" method="POST">
                <input type="hidden" name="bestelling_id" value="<?php echo $fetch_bestelling['idbestelling']; ?>">
                <select name="update_betaling">
                    <option disabled selected><?php echo $fetch_bestelling['status']; ?></option>
                    <option value="Afwachting">Afwachting</option>
                    <option value="Voltooid">Voltooid</option>
                </select>
                <input type="submit" name="update_bestelling" value="update" class="update_bestelling_optie_knop">
                <a href="../medewerker/adminbestellingen.php?verwijder=<?php echo $fetch_bestelling['idbestelling']; ?>" class="verwijder_bestelling_knop" onclick="return confirm('verwijder dit bestelling?);">Verwijder</a>
            </form>
        </div>

        <?php
            }
        }

        ?>
    </div>
</section>

<?php
include '../user/footer.php';
?>