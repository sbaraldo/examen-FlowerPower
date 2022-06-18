<?php
require_once 'db.php';
session_start();


if(isset($_POST['betaal_btn'])) 
{
    $artikel_id = mysqli_real_escape_string($conn, $_POST['hidden_artikel']);
    $winkel_id = mysqli_real_escape_string($conn, $_POST['hidden_winkel']);
    $user_id = mysqli_real_escape_string($conn, $_POST['hidden_user']);
    $cart_id = mysqli_real_escape_string($conn, $_POST['hidden_cart']);
    
    $sql = mysqli_query($conn, "INSERT INTO bestelling (winkelwagenid) VALUES ($cart_id)");
    if($sql) 
    {
        header('Location: ../user/winkelwagen.php?query=succes');
        exit();
    } else 
    {
        header('Location: ../user/winkelwagen.php?query=fail');
        exit();
    }
} else 
{
    header('Location: ../user/winkelwagen.php?something_went_wrong');
    exit();
}