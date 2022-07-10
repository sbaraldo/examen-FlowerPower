<?php 
    require 'header.php';
    include 'nav.php';

    //Alleen als je ingelogd bent als user heb je toegang//
    if(!$_SESSION['authentication']) 
    {
        header('Location: index.php?Je-moet-inloggen');
        exit();
    }

    $get_id_user = $_SESSION['authenticationUser'] ['userID'];

    //functie verwijder gegevens met GET method, kijken is het leeg of gedeclareerd is dan query delete//
    if(isset($_GET['verwijder_artikel'])){
        $delete_id = $_GET['verwijder_artikel'];
        mysqli_query($conn, "DELETE FROM winkelwagen WHERE idwinkelwagen = '$delete_id'");
        header('location: ../user/winkelwagen.php');
    }

    //functie aantal bewerken/updaten van de winkelwagen door POST methode en declareren en initialiseren//
    if(isset($_POST['update_aantal'])){
        $idwinkelwagen = $_POST['id_winkelwagen'];
        $aantal = $_POST['aantal'];
        mysqli_query($conn, "UPDATE winkelwagen SET aantal = '$aantal' WHERE idwinkelwagen = '$idwinkelwagen'") or die('error');
        header('Location: ../user/winkelwagen.php?Aantal-update-gelukt');    
    }

    //functie bestellen door POST methode en declareren en initialiseren, winkelwagen_artikelen in een array//   
    if(isset($_POST['bestel_knop'])) {
        $winkelwagen_totaal = 0;
        $winkelwagen_artikelen[] = '';

        //gegevens selecteren van de winkelwagen die de gebruiker geselecteerd heeft en dan ophalen vanuit de database//
        $winkelwagen_query = mysqli_query($conn, "SELECT * FROM winkelwagen WHERE userid = '$get_id_user'");
        if(mysqli_num_rows($winkelwagen_query) > 0) 
        {
            while($winkelwagen_item = mysqli_fetch_assoc($winkelwagen_query)) 
            {
                //winkelwagen_artikelen heeft de naam en aantal van de toegevoegde winkelwagen door array//
                //subtotaal is de prijs * de aantal dat uitendelijk de totale prijs is//
                $winkelwagen_artikelen[] = $winkelwagen_item['naam'].' ('.$winkelwagen_item['aantal'].')';
                $subtotaal = ($winkelwagen_item['prijs'] * $winkelwagen_item['aantal']);
                $winkelwagen_totaal += $subtotaal;
            }
        }

        // krijg string terug van de elementen van een array//
        $totaal_artikelen = implode(', ', $winkelwagen_artikelen);

        // als winkelwagen_totaal geen prijs heeft is de winkelwagen leeg//
        if($winkelwagen_totaal == 0)
        {
            header('Location: winkelwagen.php?Je-winkelwagen-is-leeg');
            exit();
        }

        else 
        {
            // Anders voeg je het in de bestelling door de query INSERT INTO//
            $insert_bestelling = mysqli_query($conn, "INSERT INTO bestelling (userid, totaalproduct, totaalprijs) 
            VALUES ('$get_id_user', '$totaal_artikelen', '$winkelwagen_totaal')") or die($conn);

            // Als je het in de bestelling hebt ingevoerd wordt de items die in je winkelwagen zat verwijderd//
            if($insert_bestelling) 
            {
                $delete_cart = mysqli_query($conn, "DELETE FROM winkelwagen WHERE userid = '$get_id_user'") or die('error');

                if($delete_cart) 
                {
                    header('Location: winkelwagen.php?Bestelling-geplaatst-succes!');
                    exit();
                } 
            } else 
            {
                header('Location: winkelwagen.php?Bestelling-geplaatst-gefaald');
                exit();
            }
        }
    }

?>

<!--De getoonde artikelen die je hebt toegevoegd in je winkelwagen  -->
<section class="winkelwagen">
    <div class="box-container">
    <?php
            //eindtotaal is 0 en selecteert de gebruiker die ingelogd is en haalt gegevens op van de database// 
            $eindtotaal = 0;
            $select_winkelwagen = mysqli_query($conn, "SELECT * FROM winkelwagen WHERE userid = $get_id_user ");
            if(mysqli_num_rows($select_winkelwagen) > 0) {
                while($data = mysqli_fetch_assoc($select_winkelwagen)) {
                    ?>
                        <div class="box">
                            <img src="../img_upload/<?php echo $data['foto']; ?>" alt="" class="image">
                            <div class="naam"><?php echo $data['naam']; ?></div>
                            <div class="omschrijving"><?php echo $data['omschrijving']; ?></div>
                            <div class="prijs">€<?php echo $data['prijs']; ?></div>
                            <input type="hidden" name="id_artikel" value="<?php echo $data ['artikelid']; ?>";>
                            <a href="../user/winkelwagen.php?verwijder_artikel=<?php echo $data['idwinkelwagen']?>"> 
                            <button class="verwijder_winkelwagen_knop">Verwijder uit winkelwagen</button></a>
                            <form action="" method="POST">

                                <!--Input staat hidden maar de waardes worden meegenomen naar de database  -->
                                <input type="hidden" value="<?php echo $data['idwinkelwagen']; ?>" name="id_winkelwagen">
                                <input type="number" min="1" value="<?php echo $data['aantal']; ?>" name="aantal" class="aantal">
                                <input type="submit" value="update" class="update_winkelwagen_knop" name="update_aantal">
                            </form>
                            <div class="subtotaal"> sub totaal: €<?php echo $subtotaal = ($data['prijs'] * $data['aantal']); ?></div>
                        </div>

                    <?php
                    $eindtotaal += $subtotaal;
                }
            }
        ?>

    </div>
    
    <!-- als je op bestel knop drukt dan bestel je het en krijg je een melding te zien -->
    <div class="winkelwagen-totaal">
        <p>Eindtotaal: €<?php echo $eindtotaal;?></p>
        <form action="" method="POST">
            <button type="submit" class="bestel_knop" name="bestel_knop" onclick="return confirm('Is dit wat u wilt bestellen?');">Bestel</button>
        
        </form>
        
    </div>

    
</section>


<?php 
    include 'footer.php';
?>