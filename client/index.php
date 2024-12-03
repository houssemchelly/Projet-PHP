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
