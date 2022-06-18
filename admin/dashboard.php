<?php
require '../user/header.php'; 
include 'dashnav.php';

if(!$_SESSION['authenticationRole'] == '1')
{   
    header('Location: ../user/index.php?NOT AUTHORIZED GO LOGIN YOU NOOB');
    exit(0);
} 

?>


<div class="banner">
    <img class="banner-img" src="../img/bloemenwinkel2.jpg">
</div>

<?php 
include '../user/footer.php';
?>