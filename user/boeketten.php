<?php 
    require 'header.php';
    include 'nav.php';
?>

<section class="producten">
    <h2 class="titel">Boeketten</h2>
    <div class="box-container">
        <?php
            $select_product = mysqli_query($conn, "SELECT * FROM artikel");
            if(mysqli_num_rows($select_product) > 0 ) 
            {
                while($fetch_product = mysqli_fetch_assoc($select_product)) {
                    ?>
                        <form action="../sessions/winkelwagen.session.php" method="POST" class="box">
                            <img src="../img_upload/<?php echo $fetch_product['foto']; ?>" alt="" class="image">
                            <div class="naam" name="artikel_naam"><?php echo $fetch_product['naam']; ?></div>
                            <div class="omschrijving"><?php echo $fetch_product['omschrijving']; ?></div>
                            <div class="prijs">€<?php echo $fetch_product['prijs']; ?></div>

                            <input type="text" name="aantal" value="1" min="0" class="aantal">
                            <input type="hidden" name="idartikel" value="<?=$fetch_product['idartikel']; ?>">
                            <input type="hidden" name="foto" value="<?=$fetch_product['foto']; ?>">
                            <input type="hidden" name="winkel_id" value="<?=$fetch_product['winkelid']; ?>">
                            <!-- <input type="hidden" name="user_id" value="<?=$_SESSION['authenticationUser']['userID'];?>"> -->
                   
                            <button type="submit" name="add_to_cart">Toevoegen Winkelwagen</button>
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