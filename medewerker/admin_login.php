<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body>

    <header>
        <div class="logo_titel">
            <a href="../user/index.php"><h1>Flower Power</h1></a>
        </div>
    </header>

    <!-- login admin formulier -->
    <section class="login_form">
        <div class="form_container">
            <div class="login_titel">
                <h1>Login Admin</h1>
            </div>

            <form class="login_input" action="../sessions/admin.login.php" method="POST">
                <div class="input_box">
                    <label>Email</label>
                    <input type="email" name="email" required placeholder="Email">
                </div>

                <div class="input_box">
                    <label>Wachtwoord</label>
                    <input type="password" name="wachtwoord" required placeholder="Wachtwoord">
                </div>

                <div class="login_box">
                    <button type="submit" name="login_admin_knop">Login</button>
                </div>
            </form>

            <!-- Gebruiker login link -->
            <div class="login_admin_link">
                <a href="../user/login.php"><button class="admin_link_knop">Login User</button></a>
            </div>
        </div>
    </section>
</body>
</html>