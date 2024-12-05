<?php
include '../../connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "SELECT * FROM animal WHERE id = :id";
    $stmt = $bd->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    $animal = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'animal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Modifier l'animal</h1>
        <?php if (isset($animal)): ?>
        <form action="enregister.php" method="POST">
            id: <input type="number" readonly name="id" value="<?php echo htmlspecialchars($animal['id']); ?>"><br>
            type: <input type="text" name="type" value="<?php echo htmlspecialchars($animal['type']); ?>" required><br>
            categorie: 
            <?php
                $animal=$bd->query("SELECT * FROM categories");
                echo "<select name='id_categories'>";
                foreach($animal->fetchAll() as $line) {
                    echo "<option value='".$line['id']."'>".$line['nom']."</option>";
                }
                echo "</select><br>";
            ?>
            <input type="submit" value="Modifier">
        </form>
        <?php else: ?>
            <p class="error">Produit non trouvé.</p>
        <?php endif; ?>
    </div>
</body>
</html>
