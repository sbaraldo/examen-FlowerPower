<?php 
    require '../user/header.php';
    // include 'dashnav.php';

    $idartikel = $_GET['bewerk'];

    if(isset($_POST['product_bewerken'])) {
        $naam = $_POST['naam'];
        $omschrijving = $_POST['omschrijving'];
        $prijs = $_POST['prijs'];
        $foto = $_FILES['foto']['name'];
        // $foto_tmp_name = $_FILES['foto']['tmp_name'];
        $foto_folder = '..pic/'.$foto;
    
        if(empty($naam) || empty($omschrijving) || empty($prijs)) {
            $message[] = 'Vul alles in';
        } 
        else {
            $query = "UPDATE artikel SET naam = '$naam', omschrijving = '$omschrijving', prijs = '$prijs', foto = '$foto'
            WHERE idartikel = $idartikel";
            $query_run = mysqli_query($conn,$query);
    
            if($query) {
                $message[] = 'Product bewerkt gelukt!';
            }
            else {
                $message[] = 'Kan niet toevoegen';
            }
    
        } 
    }

?>

<div class="container">
    <div class="product-form-container">    
        <?php
            if(isset($message)) {
                foreach($message as $message) {
                    echo '<span class="message">'.$message.'</span>';
                }
            } 
            
            $select = mysqli_query($conn, "SELECT * FROM artikel WHERE idartikel = '$idartikel'");
            if(mysqli_num_rows($select) > 0) 
            {
                while($row = mysqli_fetch_assoc($select)) {
                    ?>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                            <h3>Bewerk product</h3>
                            <img src="../img_upload/<?php echo $row['foto']?>" class="img">
                            <input type="text" placeholder="Product naam" value="<?php echo $row['naam'] ?>" name="naam" class="box">
                            <textarea cols="30" rows="5" placeholder="Omschrijving" name="omschrijving" class="box"><?php echo $row['omschrijving'] ?></textarea>
                            <input type="number"  min="0" placeholder="Prijs" value="<?php echo $row['prijs'] ?>" name="prijs" class="box">
                            <input type="file" accept="image/jpg, image/jpeg, image/png" name="foto" class="box">
                            <input type="submit" class="knop" name="product_bewerken" value="product bewerken">
                            <a href="../admin/producten.php" class="knop">Ga terug</a>
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