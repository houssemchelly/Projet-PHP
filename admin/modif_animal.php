<?php
include 'connection.php';

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
<form action="enregistrer.php" method="POST">
    <input type="number" readonly name="id" value="<?php echo htmlspecialchars($animal['id']); ?>"><br>
    <input type="text" name="type" value="<?php echo htmlspecialchars($animal['type']); ?>" required><br>
    <input type="submit" value="Modifier">
</form>
<?php
    $animal=$bd->query("SELECT * FROM categories");
    echo"<select name='id_categories'>";
    foreach($animal->fetchAll()as $line)
    {
        echo"<option value='".$line['id']."'>".$line['nom']."</option>";      
    }
    echo"</select></br>"
    ?>
<?php else: ?>
    <p>Produit non trouvé.</p>
<?php endif; ?>
