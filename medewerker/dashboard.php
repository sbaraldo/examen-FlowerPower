<?php
require '../user/header.php'; 
include 'dashnav.php';

//alleen admin en medewerker hebben toegang bij dashboard anders moet je ingelogd zijn//
if(!$_SESSION['admin_auth'])
{   
    header('Location: ../user/index.php?Je-moet-inloggen');
    exit(0);
} 

?>

<div class="banner">
    <img class="banner-img" src="../img/bloemenwinkel2.jpg">
</div>

<?php 
include '../user/footer.php';
?>