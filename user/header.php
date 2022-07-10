<?php 
    session_start();
    ob_start(); 
    include '../sessions/db.php';
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlowerPower</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/boeketten.css" />
    <link rel="stylesheet" href="../css/contact.css" />
    <link rel="stylesheet" href="../css/winkelwagen.css">
    <link rel="stylesheet" href="../css/bestelling.css">
    <link rel="stylesheet" href="../css/gegevens_bewerken.css">

    <link rel="stylesheet" href="../css/adminproducten.css">
    <link rel="stylesheet" href="../css/adminproducten_bewerken.css">
    <link rel="stylesheet" href="../css/admingegevens.css">
    <link rel="stylesheet" href="../css/admingegevens_bewerken.css">
    <link rel="stylesheet" href="../css/adminbestellingen.css">
</head>
<body>

<header class="header" id="header">
    <div class="header_wrapper" id="header_wrapper">
        <?php if(isset($_SESSION['authentication'])) 
        {
            ?>
            <!-- je toont de gebruiker -->
                <div class="role_user">
                    <?php 
                    if($_SESSION['authenticationRole'] == '0' || $_SESSION['authenticationRole'] == NULL)
                    {
                        ?>
                            <div id="role_user">
                                <h3>User</h3>
                                <!-- naam gebruiker -->
                                <?=$_SESSION['authenticationUser'] ['userName'];?>
                                <form action="../sessions/logout.php" method="POST">
                                    <button type="submit" class="logout_btn" id="btn" name="logout">Log Out</button>
                                </form>
                            </div>
                        <?php
                    } 
                    ?>
                </div>
            <?php

        } elseif(isset($_SESSION['admin_auth'])) {
            if($_SESSION['admin_rol'] == '1') 
            {
                ?>
                    <!-- je toont de admin -->
                    <div id="role_user">
                        <h3>Admin</h3>
                        <!-- naam admin -->
                        <?=$_SESSION['admin_user'] ['admin_naam'];?>
                        <form action="../sessions/logout.php" method="POST">
                            <button type="submit" class="logout_btn" id="btn" name="logout">Log Out</button>
                        </form>
                    </div>
                <?php

            } elseif($_SESSION['admin_rol'] == '2') {
                ?>
                    <!-- je toont de medewerker -->
                    <div id="role_user">
                        <!-- naam medewerker -->
                        <h3>Medewerker</h3>
                        <?=$_SESSION['admin_user'] ['admin_naam'];?>
                        <form action="../sessions/logout.php" method="POST">
                            <button type="submit" class="logout_btn" id="btn" name="logout">Log Out</button>
                        </form>
                    </div>
                <?php
            }
        } else 
        {
            ?>
                <div id="role_user">
                    <h3>Guest</h3>
                    <form action="../user/login.php" method="POST">
                        <button type="submit" class="login" id="btn" name="login_knop">Login</button>
                    </form>
                </div>
            <?php
        }
        ?>
    </div>
</header> 