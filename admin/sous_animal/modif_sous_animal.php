<?php
include '../../connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "SELECT * FROM soustype WHERE id = :id";
    $stmt = $bd->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    $animal = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<?php if (isset($animal)): ?>
<form action="enregistres.php" method="POST">
    id: <input type="number" readonly name="id" value="<?php echo htmlspecialchars($animal['id']); ?>"><br>
    type: <input type="text" name="name" value="<?php echo htmlspecialchars($animal['name']); ?>" required><br>
    image: <input type="url" name="image" value="<?php echo htmlspecialchars($animal['image']); ?>" required><br>
    type: <input type="number" name="prix" value="<?php echo htmlspecialchars($animal['prix']); ?>" required><br>


    
    categorie: 
    <?php
        $animal=$bd->query("SELECT * FROM animal");
        echo"<select name='type_id'>";
        foreach($animal->fetchAll()as $line)
        {
            echo"<option value='".$line['id']."'>".$line['type']."</option>";      
        }
        echo"</select></br>"
    ?>
    <input type="submit" value="Modifier">
</form>
    
<?php else: ?>
    <p>Produit non trouvé.</p>
<?php endif; ?>
