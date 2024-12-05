<?php
// Fichier : animal_details.php
session_start();
require '../connection.php';

// Vérifier si un ID d'animal est passé
if (!isset($_GET['idAnim'])) {
    die("Animal non spécifié.");
}

$animal_id = intval($_GET['idAnim']); // Récupérer l'ID de l'animal depuis l'URL

// Récupérer les détails de l'animal depuis la base de données
$stmt = $bd->prepare("
    SELECT s.id AS sousType_id, s.name, s.image, s.prix, a.type, c.nom AS categorie
    FROM soustype s
    INNER JOIN animal a ON s.type_id = a.id
    INNER JOIN categories c ON a.id_categories = c.id
    WHERE s.id = ?
");
$stmt->execute([$animal_id]);
$animal = $stmt->fetch();

if (!$animal) {
    die("Animal introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($animal['name']); ?></title>
    <style>
        /* Style général */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-top: 20px;
            font-size: 32px;
        }

        p {
            font-size: 16px;
            color: #555;
            margin: 10px 0;
            text-align: center;
        }

        /* Image de l'animal */
        img {
            display: block;
            margin: 20px auto;
            max-width: 100%;
            height: auto;
            max-height: 400px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        img:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        /* Formulaire des favoris */
        form {
            text-align: center;
            margin-top: 20px;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        button:active {
            transform: translateY(1px);
        }

        /* Liens de navigation */
        a {
            display: block;
            text-align: center;
            color: #3498db;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #2980b9;
        }

        /* Conteneur principal */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 30px;
        }

        .container h1 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($animal['name']); ?></h1>
        <img src="<?php echo htmlspecialchars($animal['image']); ?>" alt="<?php echo htmlspecialchars($animal['name']); ?>">
        <p><strong>Prix :</strong> <?php echo htmlspecialchars($animal['prix']); ?> €</p>
        <p><strong>Type :</strong> <?php echo htmlspecialchars($animal['type']); ?></p>
        <p><strong>Catégorie :</strong> <?php echo htmlspecialchars($animal['categorie']); ?></p>

        <!-- Bouton pour ajouter aux favoris -->
        <?php if (isset($_SESSION['id'])): ?>
        <form method="POST" action="favorites.php">
            <input type="hidden" name="sousType_id" value="<?php echo htmlspecialchars($animal['sousType_id'], ENT_QUOTES, 'UTF-8'); ?>">
            <?php 
            $st = $bd->prepare("SELECT COUNT(*) FROM favoris WHERE utilisateur_id = ? AND sousType_id = ?");
            $st->execute([$_SESSION['id'], $animal['sousType_id']]);
            if ($st->fetchColumn() > 0): ?>
                <button type="submit" name="action" value="remove">Supprimer des favoris</button>
            <?php else: ?>
                <button type="submit" name="action" value="add">Ajouter aux favoris</button>
            <?php endif; ?>
        </form>
        <?php else: ?>
        <p><a href="login1.php">Connectez-vous</a> pour ajouter cet animal aux favoris.</p>
        <?php endif; ?>

        <a href="<?php echo isset($_SESSION['id']) ? 'index.php?user=' . $_GET['user'] . '&id=' . $_SESSION['id'] : 'index.php'; ?>">Retour à la liste des animaux</a>
    </div>
</body>
</html>
