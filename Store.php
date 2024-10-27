<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
<header><H1>SUKKAR STORE </H1></header>    
<form action="Store.php" method="post">
<form action="save_product.php" method="POST">
        <label for="product_name">Product Name:</label><br>
        <input type="text" id="product_name" name="product_name" required><br><br>
        
        <label for="product_description">Product Description:</label><br>
        <textarea id="product_description" name="product_description"></textarea><br><br>

        <label for="quantity">Quantity:</label><br>
        <input type="number" id="quantity" name="quantity" required><br><br>
        
        <label for="price">Price:</label><br>
        <input type="number" step="0.01" id="price" name="price" required><br><br>

        <label for="category_id">Category ID:</label><br>
        <input type="number" id="category_id" name="category_id"><br><br>

        <label for="brand_id">Brand ID:</label><br>
        <input type="number" id="brand_id" name="brand_id"><br><br>

        <label for="discount_percentage">Discount Percentage:</label><br>
        <input type="number" step="0.01" id="discount_percentage" name="discount_percentage"><br><br>

        <label for="discount_end_date">Discount End Date:</label><br>
        <input type="date" id="discount_end_date" name="discount_end_date"><br><br>

        <button type="submit">Add Product</button>
        <button onclick="window.location.href='login.php';">Go to Login</button>


      

</form>


</body>
</html>

<?php 

$servername="localhost";
$username= "root";
$password="Koko@1234";
$dbname= "products";


$connection = new mysqli($servername, $username, $password, $dbname);

if($connection ->connect_error){
die("connection failed :" . $connection ->connect_error);

}
$sql= "INSERT INTO Product (product_name,product_description,quantity,price,category_id,brand_id,discount_percentage,discount_end_date)
 VALUES (?, ?, ?, ?, ?, ?, ?, ?)";


$stmt = $connection->prepare($sql);
$stmt->bind_param("ssidiids", $product_name, $product_description, $quantity, $price, $category_id, $brand_id, $discount_percentage, $discount_end_date);


$product_name = htmlspecialchars(trim($_POST['product_name']));
$product_description = htmlspecialchars(trim($_POST['product_description']));
$quantity = filter_var($_POST['quantity'], FILTER_VALIDATE_INT);
$price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
$category_id = isset($_POST['category_id']) ? filter_var($_POST['category_id'], FILTER_VALIDATE_INT) : null;
$brand_id = isset($_POST['brand_id']) ? filter_var($_POST['brand_id'], FILTER_VALIDATE_INT) : null;
$discount_percentage = isset($_POST['discount_percentage']) ? filter_var($_POST['discount_percentage'], FILTER_VALIDATE_FLOAT) : null;
$discount_end_date = isset($_POST['discount_end_date']) ? $_POST['discount_end_date'] : null;


if (!$product_name || !$product_description || $quantity === false || $price === false) {
    die("Invalid input data. Please check your entries.");
}
if ($stmt->execute()) {
    echo "New product added successfully!";
} else {
    echo "Error: " . $stmt->error;
}


?>