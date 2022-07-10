<?php
require '../user/header.php'; 
include 'dashnav.php';

//functie product toevoegen door POST methode en declareren en initialiseren//
if(isset($_POST['product_toevoegen'])) {

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

                //kijken als het empty is, als het empty is krijg je een bericht en als het niet empty is query insert into om te toevoegen//
                if(empty($naam) || empty($omschrijving) || empty($prijs) || empty($new_foto_naam))
                {
                    header('location: ../admin/adminproducten.php?Leeg');
                    $message[] = 'Vul alles in';
                    exit();
                } else 
                {
                    $query_insert = mysqli_query($conn, "INSERT INTO artikel (naam ,omschrijving, prijs, foto)
                    VALUES ('$naam', '$omschrijving', '$prijs', '$new_foto_naam')") or die ('error');

                    if($query_insert) {
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

//functie verwijderen product met GET method, kijken of het leeg of gedeclareerd is dan query delete om te verwijderen//
if(isset($_GET['verwijder'])) {

    $idartikel = $_GET['verwijder'];
    mysqli_query($conn, "DELETE FROM artikel WHERE idartikel = $idartikel");
    mysqli_query($conn, "DELETE FROM winkelwagen WHERE artikelid = $idartikel");
    header('location: ../admin/adminproducten.php');
}

?>

<!-- product toevoegen formulier -->
<div class="container">
    <div class="product-form-container">
            
    <!-- bericht laten zien -->
        <?php 
            if(isset($message)) {
                foreach($message as $message) {
                echo '<span class="message">'.$message.'</span>';
                }
            }
        ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <h3>Product toevoegen</h3>
            <input type="text" placeholder="Product naam" name="naam" class="box">
            <textarea cols="30" rows="5" placeholder="Omschrijving" name="omschrijving" class="box"></textarea>
            <input type="number"  min="0" placeholder="Prijs" name="prijs" class="box">
            <input type="file" accept="image/jpg, image/jpeg, image/png" name="foto" class="box"> 
            <input type="submit" class="knop" name="product_toevoegen" value="Product toevoegen">
        </form>
    </div>

    
        
        <!-- tabel om toegevoegde producten te laten zien -->
        <div class="toon-product">
        <table class="toon-product-table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Product naam</th>
                    <th>Omschrijving</th>
                    <th>Prijs</th>
                    <th colspan="2">Actie</th>
                </tr>
            </thead>
            <?php 

                //gegevens selecteren van artikel en ophalen van de database// 
                $select_artikel = mysqli_query($conn, "SELECT * FROM artikel");
                if(mysqli_num_rows($select_artikel) > 0) 
                {
                  while($row = mysqli_fetch_assoc($select_artikel)) 
                  { 
                    ?>
                        <tr>
                            <td><img src="../img_upload/<?php echo $row['foto']; ?>" height="100" alt=""></td>
                            <td><?php echo $row['naam']; ?></td>
                            <td><?php echo $row['omschrijving']; ?></td>
                            <td>€ <?php echo $row['prijs']; ?></td>
                            <td>
                                <a href="../admin/adminproducten_bewerken.php?bewerk=<?php echo $row['idartikel']?>"> 
                                <button class="bewerken_knop">Bewerken</button></a>
                                <a href="../admin/adminproducten.php?verwijder=<?php echo $row['idartikel']?>"> 
                                <button class="verwijder_knop">Verwijder</button></a>
                            </td>
                        </tr>
                    <?php
                    }
                }
            ?>    
        </table>
    </div>
</div>

<?php 
include '../user/footer.php';
?>