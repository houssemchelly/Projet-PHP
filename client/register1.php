<?php include "register.php";?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <div class="form-container">
        <h2>S'inscrire</h2>
        <!-- Affichage des messages -->
        
            <?php
            if (isset($_SESSION['error'])) {
                echo "<p class='error'>" . $_SESSION['error'] . "</p>";
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                echo "<p class='success'>" . $_SESSION['success'] . "</p>";
                unset($_SESSION['success']);
            }
            ?>
        <form action="" method="POST">
            <input type="text" name="nom" placeholder="Nom d'utilisateur" >
            <input type="email" name="email" placeholder="Email" >
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" >
            <button type="submit">S'inscrire</button>
        </form>
        <p>Déjà inscrit ? <a href="login1.php">Connectez-vous ici</a></p>
    </div>
</body>
</html>