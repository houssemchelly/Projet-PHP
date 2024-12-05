<?php
// Fichier : index.php
require '../connection.php';
session_start();
// Récupérer tous les animaux
$stmt = $bd->query("
    SELECT s.id AS sousType_id, s.name, s.image, s.prix, c.nom AS categorie
    FROM soustype s
    INNER JOIN animal a ON s.type_id = a.id
    INNER JOIN categories c ON a.id_categories = c.id
");
$animaux = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des animaux</title>
    <style>
        /* Style général */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
            margin: 20px 0;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        /* Boutons de connexion/déconnexion */
        body > a {
            display: block;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        /* Conteneur des animaux */
        div {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin: 0 auto 20px auto;
            max-width: 600px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        div img {
            max-width: 150px;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
            display: block;
        }
        div h2 {
            font-size: 1.5em;
            margin: 10px 0;
            color: #333;
        }
        div p {
            margin: 5px 0;
            color: #666;
        }
        div a {
            display: inline-block;
            margin-top: 10px;
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        div a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Liste des animaux</h1>    
    <?php 
    if(isset($_SESSION['id'])){ 
        echo "<a href='logout.php'>logout</a>";
    }else{ 
        echo "<a href='login1.php'>login</a>";
    } 
    ?>
    <?php foreach ($animaux as $animal){ ?>
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <h2><?php echo htmlspecialchars($animal['name']); ?></h2>
            <img src="<?php echo htmlspecialchars($animal['image']); ?>" alt="<?php echo htmlspecialchars($animal['name']); ?>" style="max-width: 150px;">
            <p>Prix : <?php echo htmlspecialchars($animal['prix']); ?> DT</p>
            <p>Catégorie : <?php echo htmlspecialchars($animal['categorie']); ?></p>
            <?php 
                if(isset($_SESSION['id'])){ ?>
                    <a href="animal_details.php?user=<?php echo $_GET['user']; ?>&id=<?php echo $_GET['id']; ?>&idAnim=<?php echo $animal['sousType_id']; ?>">Voir les détails</a>
                    <?php 
                }else{ ?>
                    <a href="animal_details.php?idAnim=<?php echo $animal['sousType_id']; ?>">Voir les détails</a>
                <?php 
                } ?>
                
        </div>
    <?php } ?>
</body>
</html>
