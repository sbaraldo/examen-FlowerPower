<?php 
require 'header.php';

//Alleen als je ingelogd bent als user heb je toegang//
if(!$_SESSION['authentication']) 
{
    header('Location: index.php?Je-moet-inloggen');
    exit();
}

include 'nav.php';
?>

<!-- toon gegevens van de bestelling -->
<section class="bestellingen">
    <h1 class="titel">Factuur bestelling</h1>


    <div class="box-container">

        <?php
            // gegevens selecteren van bestelling en dan ophalen van de database// 
            $user_id = $_SESSION['authenticationUser'] ['userID'];
            $select_bestelling= mysqli_query($conn, "SELECT * FROM bestelling INNER JOIN users ON bestelling.userid = users.iduser 
            WHERE userid = '$user_id'") or die('error');
            if(mysqli_num_rows($select_bestelling) > 0)
            {
                while($fetch_bestelling = mysqli_fetch_assoc($select_bestelling)) 
                { 
                    ?>
                        <div class="bestellingen_box">
                            <p> Voornaam : <?php echo $fetch_bestelling['voornaam']; ?></p>
                            <p> Tussenvoegsel : <?php echo $fetch_bestelling['tussenvoegsel']; ?></p>
                            <p> Achternaam : <?php echo $fetch_bestelling['achternaam']; ?></p>
                            <p> Adres : <?php echo $fetch_bestelling['adres']; ?></p>
                            <p> Huisnummer : <?php echo $fetch_bestelling['huisnummer']; ?></p>
                            <p> Postcode : <span><?php echo $fetch_bestelling['postcode']; ?></span></p>
                            <p> Plaats : <?php echo $fetch_bestelling['plaats']; ?></p>
                            <p> Telefoon : <?php echo $fetch_bestelling['telefoon']; ?></p>
                            <p> Geboortedatum : <?php echo $fetch_bestelling['geboortedatum']; ?></p>
                            <p> Email : <?php echo $fetch_bestelling['email']; ?></span></p>
                            <p> Totaal Product : <?php echo $fetch_bestelling['totaalproduct']; ?></p>
                            <p> Totaal Prijs : €<?php echo $fetch_bestelling['totaalprijs']; ?></p>
                            <p> betaling status : <?php echo $fetch_bestelling['status']; ?></p>

                        </div>
                    <?php
                }
            } else 
            {
                header('Location: ../user/winkelwagen.php?Geen-producten-toegevoegd-of-nog-niet-besteld');
            }
        ?>
    </div>
</section>