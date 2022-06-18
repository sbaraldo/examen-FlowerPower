<?php
require '../user/header.php'; 
?>
<div id="container">
    <main class="input_content">
        <?php include 'dashnav.php';?>
        <h3>Winkel Toevoegen</h3>
        <form class="input_winkel" action="../sessions/winkel.session.php" method="POST">
            <div>
                <label>Winkel Adres</label>
                <input type="text" name="winkel_adres" placeholder="Adres">
            </div>
            <div>
                <label>Winkel Email</label>
                <input type="email" name="winkel_email" placeholder="Email">
            </div>
            <div>
                <label>Winkel Huisnummer</label>
                <input type="text" name="winkel_huis_nr" placeholder="Huisnummer">
            </div>
            <div>
                <label>Winkel Plaats</label>
                <input type="text" name="winkel_plaats" placeholder="Plaats">
            </div>
            <div>
                <label>Winkel Postcode</label>
                <input type="text" name="winkel_postcode" placeholder="Postcode">
            </div>
            <div>
                <label>Winkel Telefoonnummer</label>
                <input type="text" name="winkel_tel_nr" placeholder="Telefoonnummer">
            </div>

            <div>
                <button class="winkel_btn" name="winkel_btn">Add</button>
            </div>
        </form>
    </main>
</div>

<?php 
include '../user/footer.php';
?>