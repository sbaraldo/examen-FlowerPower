<?php 
    require '../user/header.php';
    // include 'dashnav.php';

    $idartikel = $_GET['bewerk'];

    //functie product bewerken/updaten door POST methode en declareren en initialiseren//
if(isset($_POST['product_bewerken'])) {

    $naam = $_POST['naam'];
    $omschrijving = $_POST['omschrijving'];
    $prijs = $_POST['prijs'];

    $foto_name = $_FILES['foto']['name'];
    $foto_size = $_FILES['foto']['size'];
    $foto_temp_name = $_FILES['foto']['tmp_name'];
    $error = $_FILES['foto']['error'];
    
    if($error === 0) 
    {
        if($foto_size > 1000000)
        {
            header('location: ../admin/adminproducten.php?File-te-groot');
            exit();
        } else 
        {
            //Overzetten de foto gegevens en mag bepaalde foto bestanden toelaten//
            $foto_extention = pathinfo($foto_name, PATHINFO_EXTENSION);
            $foto_ext_conv = strtolower($foto_extention);
            $exst = array("jpg", "jpeg", "png");

            if(in_array($foto_ext_conv, $exst)) 
            {
                //foto's krijgen nieuwe id en upload naar ../img_upload/ //
                $new_foto_naam = uniqid("IMG-", true).'.'.$foto_ext_conv;
                $foto_path = '../img_upload/'.$new_foto_naam;
                move_uploaded_file($foto_temp_name, $foto_path);

                //kijken als het empty is, als het empty is krijg je een bericht en als het niet empty is query update om te updaten//
                if(empty($naam) || empty($omschrijving) || empty($prijs) || empty($new_foto_naam))
                {
                    $message[] = 'Vul alles in';
                    exit();
                } 
                else {
                    $query_update = "UPDATE artikel SET naam = '$naam', omschrijving = '$omschrijving', prijs = '$prijs', foto = '$new_foto_naam'
                    WHERE idartikel = $idartikel";
                    $query_run = mysqli_query($conn,$query_update);

                    if($query_update) {
                        $message[] = 'Product toegevoegd gelukt!';
                    }
                    else {
                        $message[] = 'Kan niet toevoegen';
                    }
                }
            }
        }
    }
}

?>

<!--formulier van de producten met de gegevens erbij -->
<div class="container">
    <div class="product-form-container">    
        <?php
            if(isset($message)) {
                foreach($message as $message) {
                    echo '<span class="message">'.$message.'</span>';
                }
            } 
            
            //selecteert de artikelen en haalt gegevens op van de database//
            $select_artikel = mysqli_query($conn, "SELECT * FROM artikel WHERE idartikel = '$idartikel'");
            if(mysqli_num_rows($select_artikel) > 0) 
            {
                while($row = mysqli_fetch_assoc($select_artikel)) {
                    ?>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                            <h3>Bewerk product</h3>
                            <img src="../img_upload/<?php echo $row['foto']?>" class="img">
                            <input type="text" placeholder="Product naam" value="<?php echo $row['naam'] ?>" name="naam" class="box">
                            <textarea cols="30" rows="5" placeholder="Omschrijving" name="omschrijving" class="box"><?php echo $row['omschrijving'] ?></textarea>
                            <input type="number"  min="0" placeholder="Prijs" value="<?php echo $row['prijs'] ?>" name="prijs" class="box">
                            <input type="file" accept="image/jpg, image/jpeg, image/png" name="foto" class="box">
                            <input type="submit" class="knop" name="product_bewerken" value="product bewerken">
                            <a href="../admin/adminproducten.php" class="knop">Ga terug</a>
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