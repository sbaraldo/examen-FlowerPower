<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <title>Login</title> -->
    <link rel="stylesheet" type="text/css" href="../css/login.css" />
</head>
<body>
    
    <header>
        <div class="logo_titel">
            <a href="index.php"><h1>Flower Power</h1></a>
        </div>
    </header>
    
    <section class="login_form">
        <div class="form_container">
            <div class="login_titel">
                <h1>Login User</h1>
            </div>

            <form class="login_input" action="../sessions/user_login.php" method="POST">
                <div class="input_box">
                    <label>Email</label>
                    <input type="email" name="email" required placeholder="Email">
                </div>

                <div class="input_box">
                    <label>Wachtwoord</label>
                    <input type="password" name="wachtwoord" required placeholder="Wachtwoord">
                </div>

                <div class="login_box">
                    <button type="submit" name="login_knop">Login</button>
                </div>
            </form>

            <!-- Registeer link -->
            <div class="registreer_box">
                <h4>Nog geen account?</h4>
                <a href="register.php">Registreer nu!</a>
            </div>

            <!-- Login admin link -->
            <div class="login_admin_link">
                <a href="../admin/admin_login.php"><button class="admin_link_knop">Login Admin</button></a>
            </div>
            
        </div>
    </section>
</body>
</html>
