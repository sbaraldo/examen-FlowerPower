<?php 
    require 'header.php';
    include 'nav.php';

    // Alleen als je ingelogd bent als gebruiker kan je op de winkelwagen_toevoegen drukken door POST methode//
    if(isset($_POST['winkelwagen_toevoegen'])) {
    if($_SESSION['authentication'])
    {
        // Declareren en initialiseren en dan selecteer je de artikel naam die je hebt gekozen en de ingelogde gebruiker
        $user_id = $_SESSION['authenticationUser']['userID'];
        $artikel_id = $_POST['idartikel'];
        $artikel_naam = $_POST['artikel_naam'];
        $artikel_omschrijving = $_POST['artikel_omschrijving'];
        $artikel_prijs = $_POST['artikel_prijs'];
        $artikel_foto = $_POST['artikel_foto'];
        $artikel_aantal = $_POST['artikel_aantal'];

        $winkelwagen_check_query = mysqli_query($conn, "SELECT * FROM winkelwagen WHERE naam = '$artikel_naam' and userid = '$user_id'") or die ('error');
        
        //Checken of je die artikel al hebt toegevoegd in je winkelwagen anders voeg je het toe in je winkel wagen met INSERT INTO//
        if(mysqli_num_rows($winkelwagen_check_query) > 0) {
            header('Location: ../user/boeketten.php?Al-toegevoegd-in-winkelwagen');
        }else {
            
            mysqli_query($conn, "INSERT INTO winkelwagen(userid, artikelid, naam, omschrijving, prijs, aantal, foto)
            VALUES('$user_id', '$artikel_id', '$artikel_naam', '$artikel_omschrijving', '$artikel_prijs', '$artikel_aantal', '$artikel_foto')") or die('error');
            header('Location: ../user/boeketten.php?Toegevoegd-in-winkelwagen-gelukt');
        }
    }
}

?>
<!-- De getoonde artikelen in een formulier -->
<section class="producten">
    <h2 class="titel_boeket">Boeketten</h2>
    <p class="subtitel_boeket"> Je moet ingelogd zijn om naar winkelwagen toevoegen.</p>
    <div class="box-container">
        <?php
            // Gegevens selecteren van artikel en ophalen van de database//
            $select_artikel = mysqli_query($conn, "SELECT * FROM artikel");
            if(mysqli_num_rows($select_artikel) > 0 ) 
            {
                while($fetch_artikel = mysqli_fetch_assoc($select_artikel)) {
                    ?>
                        <form action="" method="POST" class="box">
                            <img src="../img_upload/<?php echo $fetch_artikel['foto']; ?>" alt="" class="image">
                            <div class="naam"><?php echo $fetch_artikel['naam']; ?></div>
                            <div class="omschrijving"><?php echo $fetch_artikel['omschrijving']; ?></div>
                            <div class="prijs">€<?php echo $fetch_artikel['prijs']; ?></div>
                            <input type="number" name="artikel_aantal" value="1" min="1" class="aantal">

                            <!-- Input staat hidden maar de waardes worden meegenomen naar de database -->
                            <input type="hidden" name="idartikel" value="<?=$fetch_artikel['idartikel']; ?>">
                            <input type="hidden" name="artikel_naam" value="<?=$fetch_artikel['naam']; ?>">
                            <input type="hidden" name="artikel_omschrijving" value="<?=$fetch_artikel['omschrijving']; ?>">
                            <input type="hidden" name="artikel_prijs" value="<?=$fetch_artikel['prijs']; ?>">
                            <input type="hidden" name="artikel_foto" value="<?=$fetch_artikel['foto']; ?>">
                   
                            <button class="boeketten_knop" type="submit" name="winkelwagen_toevoegen">Toevoegen Winkelwagen</button>
                        </form>
                    <?php
                }
            }                              
        ?>
    </div>
</section>

<?php 
    include 'footer.php';
?>