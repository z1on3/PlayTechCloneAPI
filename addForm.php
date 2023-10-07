<?php
    require_once('includes/db.php');
    // Create a new database instance
    $db = new Database();
    // Get the database connection
    $connection = $db->getConnection();
    $sql = "SELECT * FROM categories";
    $results = $db->fetchAll($sql); 
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h1>Add a New Product</h1>
    <form action="addProduct.php" method="post" enctype="multipart/form-data">
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" required>
        <br><br>

        <label for="price">Price (PHP):</label>
        <input type="number" id="price" name="price" step="0.01" required>
        <br><br>

        <label for="categ">Category:</label>
        <select name="categ">
    <?php foreach ($results as $row): ?>
        <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></option>
    <?php endforeach; ?>
</select>
<br><br>

        <label for="image">Image</label>
        <input type="file" id="image" name="image" required>
        <br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>
        <br><br>

        <input type="submit" value="Add Product">
    </form>
</body>
</html>
