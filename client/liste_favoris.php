<?php
// Fichier : index.php
require '../connection.php';
session_start();
// Récupérer tous les animaux
$stmt = $bd->query("
    SELECT f.*, s.name, s.image from favoris f, soustype s where f.sousType_id=s.id and utilisateur_id=".$_SESSION['id']);
$animaux = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des favoris</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            color: #333;
            margin-top: 20px;
        }
        .animal-container {
            width: 90%;
            max-width: 800px;
            margin: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .animal-container h2 {
            margin-bottom: 10px;
            color: #666;
        }
        .animal-container img {
            max-width: 150px;
            display: block;
            margin-bottom: 10px;
        }
        .animal-container a {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
        .animal-container a:hover {
            background-color: #45a049;
        }
        .auth-links {
            margin-bottom: 20px;
        }
        .auth-links a {
            margin: 0 10px;
            color: #0066cc;
            text-decoration: none;
        }
        .auth-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Liste des favoris</h1>    
    <div class="auth-links">
        <?php 
        if(isset($_SESSION['id'])){ 
            echo "<a href='logout.php'>logout</a>";
        }else{ 
            echo "<a href='login1.php'>login</a>";
        } 
        ?>
    </div>
    <?php foreach ($animaux as $animal){ ?>
        <div class="animal-container">
            <h2><?php echo htmlspecialchars($animal['name']); ?></h2>
            <img src="<?php echo htmlspecialchars($animal['image']); ?>" alt="<?php echo htmlspecialchars($animal['name']); ?>">
            <?php 
                if(isset($_SESSION['id'])){ ?>
                    <a href="animal_details.php?user=<?php echo $_GET['user']; ?>&id=<?php echo $_GET['id']; ?>&idAnim=<?php echo $animal['sousType_id']; ?>">Voir les détails</a>
                <?php }else{ ?>
                    <a href="animal_details.php?idAnim=<?php echo $animal['sousType_id']; ?>">Voir les détails</a>
                <?php } ?>
        </div>
    <?php } ?>
</body>
</html>
