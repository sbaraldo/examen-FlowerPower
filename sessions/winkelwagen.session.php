<?php
include 'db.php';
session_start();

if(isset($_POST['add_to_cart'])) {
    if($_SESSION['authentication']) 
    {
        $artikel_id = $_POST['idartikel'];
        // $user_id = $_POST['user_id'];
        $user_id = $_SESSION['authenticationUser']['userID'];

        $query = mysqli_query($conn, "INSERT INTO winkelwagen (userid, artikelid) 
        VALUES ('$user_id', '$artikel_id')") or die (mysqli_error($conn));

        if($query) 
        {
            header('Location: ../user/boeketten.php?SUCCES');
            exit(0);
        } else 
        {
            header('Location: ../user/boeketten.php?NO SUCCES');
            exit(0);
        }

    } else 
    {
        header('Location: ../user/boeketten.php?NOT AUTH');
        exit(0);
    }
}