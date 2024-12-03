<?php include 'login.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <div class="form-container">
        <h2>login</h2>
        <!-- Affichage des messages -->
        
            <?php
            if (isset($_SESSION['error'])) {
                echo "<p class='error'>" . $_SESSION['error'] . "</p>";
                unset($_SESSION['error']);
            }
            ?>
        <form action="" method="POST">
            <input type="text" name="nom" placeholder="Nom d'utilisateur" >
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" >
            <button type="submit">S'inscrire</button>
        </form>
        <p>n'a pas un compte ? <a href="register1.php">inscrire ici</a></p>
        <a href="index.php">continue without login</a>
    </div>
</body>
</html>