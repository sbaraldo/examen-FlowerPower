<?php 
    require 'header.php';
    include 'nav.php';

    if(!$_SESSION['authentication']) 
    {
        header('Location: index.php?NOT AUTHORIZED GO LOGIN YOU NOOB');
        exit();
    }
?>

<section class="winkelwagen">
    <div class="box-container">
        <?php 
            $get_id_user = $_SESSION['authenticationUser']['userID'];
            $sql = mysqli_query($conn, "SELECT * FROM winkelwagen 
            INNER JOIN artikel ON winkelwagen.artikelid = artikel.idartikel WHERE winkelwagen.userid = $get_id_user");
            if(mysqli_num_rows($sql) > 0) 
            {
                while($data = mysqli_fetch_assoc($sql))
                {
                    ?>
                        <div class="box_wrapper">
                            <div class="item_info">
                                <div class="box">
                                    <fiure id="" class="box_img">
                                        <img src="../img_upload/<?php echo $data['foto'];?>">
                                    </figure>                            
                                </div>

                                <div class="box">
                                    <h4>Naam Artikel</h4>
                                    <p><?=$data['naam'];?></p>
                                </div>

                                <div class="box">
                                    <h4>Omschrijving Artikel</h4>
                                    <p><?=$data['omschrijving'];?></p>
                                </div>

                                <div class="box">
                                    <h4>Prijs Artikel</h4>
                                    <p>€ <?=$data['prijs'];?></p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <form class="betaal_form" action="../sessions/betaal.php" method="POST">
                                <input type="text" name="hidden_artikel" value="<?=$data['idartikel'];?>">artikel</input>
                                <input type="text" name="hidden_winkel" value="<?=$data['winkelid'];?>">winkel</input>
                                <input type="text" name="hidden_user" value="<?=$get_id_user?>">user</input>
                                <input type="text" name="hidden_cart" value="<?=$data['idwinkelwagen'];?>">cart</input>
                                <button class="betaal_btn">Betaal</button>
                            </form>
                        </div>
                    <?php 
                }
            }
        ?>
</section>

<?php 
    include 'footer.php';
?>