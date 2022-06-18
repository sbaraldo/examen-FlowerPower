<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css" />
</head>
<body>
    
    <ul class="nav">
        <div class="logo"><a href="index.php">Flower Power</a></div>
    </ul>
    
    <section>
        <div class="container">
            <h1>Login</h1>
            <form class="login" action="../sessions/login.session.php" method="POST">
                <div>
                    <label>Email</label>
                    <input type="email" name="email" required placeholder="Email"> 
                </div>

                <div>
                    <label>Wachtwoord</label>
                    <input type="password" name="wachtwoord" required placeholder="Wachtwoord"> 
                </div>

                <div class="knop">
                    <button type="submit" name="login_knop">Login</button>

                    <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
