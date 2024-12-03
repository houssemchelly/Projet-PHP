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

<?php if (isset($animal)): ?>
<form action="enregister.php" method="POST">
    id: <input type="number" readonly name="id" value="<?php echo htmlspecialchars($animal['id']); ?>"><br>
    type: <input type="text" name="type" value="<?php echo htmlspecialchars($animal['type']); ?>" required><br>
    
    categorie: 
    <?php
        $animal=$bd->query("SELECT * FROM categories");
        echo"<select name='id_categories'>";
        foreach($animal->fetchAll()as $line)
        {
            echo"<option value='".$line['id']."'>".$line['nom']."</option>";      
        }
        echo"</select></br>"
    ?>
    <input type="submit" value="Modifier">
</form>
    
<?php else: ?>
    <p>Produit non trouvé.</p>
<?php endif; ?>
