<?php
include '../sessions/db.php';

// if(isset($_SESSION['auth'])) {
//     if($_SESSION['auth_role']  == '1') {
//         header('Location: dashboard.php');
//         exit(0);
//     } else {
//         header('Location: index.php');
//         exit(0);
//     }
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="../css/register.css" />
</head>
<body>
    <ul class="nav">
        <div class="logo"><a href="index.php">Flower Power</a></div>
    </ul>
    <section>
    <div class="container">
        <h1>Registreer</h1>
        <form class="register_form" action="../sessions/register.session.php" method="POST">
            <div class="splits">
                <div>
                    <label for="voonaam">Voornaam</label>
                    <input required type="text" name="voornaam" id="voornaam" placeholder="Voornaam"><br>
                </div>

                <div>
                    <label for="tussenvoegsel">Tussenvoegsel</label>
                    <input type="text" name="tussenvoegsel" id="tussenvoegsel" placeholder="tussenvoegsel"><br>
                </div>
                
                <div>
                    <label for="achternaam">Achternaam</label>
                    <input required type="text" name="achternaam" id="achternaam" placeholder="Achternaam"><br>
                </div>

                <div>
                    <label for="adres">Adres</label>
                    <input required type="text" name="adres" id="adres" placeholder="Adres"><br>
                </div>

                <div>
                    <label for="huisnummer">Huisnummer</label>
                    <input required type="text" name="huisnummer" id="huisnummer" placeholder="Huisnummer"><br>
                </div>

                <div>
                    <label for="postcode">Postcode</label>
                    <input required type="text" name="postcode" id="postcode" placeholder="Postcode"><br>
                </div>

            </div>

            <div class="splits">
                <div>
                    <label for="plaats">Plaats</label>
                    <input required type="text" name="plaats" id="plaats" placeholder="Plaats"><br>
                </div>

                <div>
                    <label for="telefoon">Telefoon</label>
                    <input required type="telefoon" name="telefoon" id="telefoon" placeholder="Telefoonnummer"><br>
                </div>

                <div>
                    <label for="geboortedatum">Geboortedatum</label>
                    <input required type="date" name="geboortedatum" id="geboortedatum"><br>
                </div>

                <div>
                    <label for="email">Email</label>
                    <input required type="email" name="email" id="email" placeholder="Email"><br><br>
                </div>

                <div>
                    <label for="wachtwoord">Wachtwoord</label>
                    <input required type="password" name="wachtwoord" id="wachtwoord" placeholder="Wachtwoord"><br>
                </div>

                <div>
                    <label for="bevestig_wachtwoord">Bevestig Wachtwoord</label>
                    <input required type="password" name="bevestig_wachtwoord" id="bevestig_wachtwoord" placeholder="Bevestig wachtwoord"><br>
                    
                    <button type="submit" name="registreer_knop">Registreer</button> 

                    <p>Al een account? <a href="login.php">Login hier</a>.</p>
                </div>
            </div>
        </form>
    </div>

</section>
</body>
</html>


