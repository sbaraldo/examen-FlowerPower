<?php 
    ob_start();
    session_start();
    include '../sessions/db.php';
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlowerPower</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" type="text/css" href="../css/boeketten.css" />
    <link rel="stylesheet" type="text/css" href="../css/contact.css" />
    <link rel="stylesheet" href="../css/winkelwagen.css">
    <link rel="stylesheet" href="../css/adminproducten.css">
    <link rel="stylesheet" href="../css/admingegevens.css">
    <link rel="stylesheet" href="../css/winkel.form.css">
</head>
<body>

<header class="header" id="header">
    <div class="header_wrapper" id="header_wrapper">
        <?php if(isset($_SESSION['authentication'])) 
        {
            ?>
            <div class="role_user">
            <?php 
            if($_SESSION['authenticationRole'] == '1')
            {
                ?>
                <div id="role_user">
                    <h5>Admin</h3>
                    <?=$_SESSION['authenticationUser']['userName'];?>
                    <form action="../sessions/logout.php" method="POST">
                        <button type="submit" class="logout_btn" id="btn" name="logout">Log Out</button>
                    </form>
                </div>
                <?php
            }elseif($_SESSION['authenticationRole'] == '0' || $_SESSION['authenticationRole'] == NULL) 
            {
                ?>
                <div id="role_user">
                    <h3>User</h3>
                    <?=$_SESSION['authenticationUser'] ['userName'];?>
                    <form action="../sessions/logout.php" method="POST">
                        <button type="submit" class="logout_btn" id="btn" name="logout">Log Out</button>
                    </form>
                    <a href="../user/gegevens_bewerken.php?gegevensbewerk="><button class="gegevens_btn"> Gegevens bewerken</button></a>
                </div>
                <?php
            }
            ?>
            </div>
            <?php
        } else 
        {
            ?>
                <div id="role_user">
                    <h3>Guest</h3>
                    <form action="../sessions/login.session.php" method="POST">
                        <button type="submit" class="login" id="btn" name="login_knop">Login</button>
                    </form>
                </div>
            <?php
        }
        ?>
    </div>
</header>
    