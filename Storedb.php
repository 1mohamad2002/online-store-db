<?php
session_start();


if(!isset($_SESSION["username"])){

header("location:login.php");
exit();
}

$servername="localhost";
$username = "root";
$password = "Koko@1234";
$dbname = "products";


$connection = new mysqli($servername, $username, $password, $dbname);


if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}


$sql=" SELECT * FROM product";

$result = $connection->query($sql);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Data</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
    <table border="1">
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product Description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Category id</th>
            <th>Brand id</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Is Active</th>
            <th>Is Featured</th>
            <!-- Add more columns as necessary -->
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Product_id'] . "</td>"; // Adjust column names
                echo "<td>" . $row['product_name'] . "</td>"; // Adjust column names
                echo "<td>" . $row['product_description'] . "</td>"; // Adjust column names
                echo "<td>" . $row['quantity'] . "</td>"; // Adjust column names
                echo "<td>" . $row['price'] . "</td>"; // Adjust column names
                echo "<td>" . $row['category_id'] . "</td>"; // Adjust column names
                echo "<td>" . $row['brand_id'] . "</td>"; // Adjust column names
                echo "<td>" . $row['created_at'] . "</td>"; // Adjust column names
                echo "<td>" . $row['updated_at'] . "</td>"; // Adjust column names
                echo "<td>" . $row['is_active'] . "</td>"; // Adjust column names
                echo "<td>" . $row['is_featured'] . "</td>"; // Adjust column names
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No data found</td></tr>"; // Adjust column count
        }
        ?>
    </table>
    <a href="Store.php">Logout</a>
</body>
</html>

<?php
$connection->close();
?>