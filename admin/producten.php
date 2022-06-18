<?php
require '../user/header.php'; 
include 'dashnav.php';

//functie product toevoegen//
if(isset($_POST['product_toevoegen'])) {

    $naam = $_POST['naam'];
    $omschrijving = $_POST['omschrijving'];
    $prijs = $_POST['prijs'];
    $winkel = $_POST['id_winkel'];

    $pic_name = $_FILES['foto']['name'];
    $pic_size = $_FILES['foto']['size'];
    $pic_temp_name = $_FILES['foto']['tmp_name'];
    $error = $_FILES['foto']['error'];
    
    if($error === 0) 
    {
        if($pic_size > 1000000)
        {
            header('location: ../admin/producten.php?fileTobig');
            exit();
        } else 
        {
            $pic_extention = pathinfo($pic_name, PATHINFO_EXTENSION);
            $pic_ext_conv = strtolower($pic_extention);
            $exst = array("jpg", "jpeg", "png");

            if(in_array($pic_ext_conv, $exst)) 
            {
                $new_pic_naam = uniqid("IMG-", true).'.'.$pic_ext_conv;
                $pic_path = '../img_upload/'.$new_pic_naam;
                move_uploaded_file($pic_temp_name, $pic_path);

                if(empty($naam) || empty($omschrijving) || empty($prijs) || empty($winkel) || empty($new_pic_naam))
                {
                    header('location: ../admin/producten.php?EMPTY');
                    $message[] = 'Vul alles in';
                    exit();
                } else 
                {
                    $query = mysqli_query($conn, "INSERT INTO artikel (winkelid, naam ,omschrijving, prijs, foto, winkelnaam)
                    VALUES ('$winkel', '$naam', '$omschrijving', '$prijs', '$new_pic_naam',
                    (SELECT winkelplaats FROM winkel WHERE idwinkel = $winkel))") or die (mysqli_error($conn));

                    if($query) {
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

//functie product verwijderen//
if(isset($_GET['verwijder'])) {

    $idartikel = $_GET['verwijder'];
    mysqli_query($conn, "DELETE FROM artikel WHERE idartikel = $idartikel");
    header('location: ../admin/producten.php');
}

?>

<!-- product toevoegen formulier -->
<div class="container">
    <div class="product-form-container">
                
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
            <select name="id_winkel">
                <option>SELECT</option>
                <?php
                    $query_select = mysqli_query($conn, "SELECT * FROM winkel");
                    while($query_data = mysqli_fetch_array($query_select))
                    {
                        ?>
                        <option value="<?=$query_data['idwinkel'];?>"><?=$query_data['winkelplaats'];?></option>
                        <?php
                    } 
                ?>
            </select>
            <input type="submit" class="knop" name="product_toevoegen" value="Product toevoegen">
        </form>
    </div>

    
        
    <!-- gegevens selecteren van artikel -->
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
                $select = mysqli_query($conn, "SELECT * FROM artikel");
                if(mysqli_num_rows($select) > 0) 
                {
                  while($row = mysqli_fetch_assoc($select)) 
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
                                <a href="../admin/producten.php?verwijder=<?php echo $row['idartikel']?>"> 
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