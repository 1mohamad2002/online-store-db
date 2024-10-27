<?php 
session_start();

$servername = "localhost";
$username = "root";
$password = "Koko@1234";
$dbname = "products";

$connection = new mysqli($servername, $username, $password, $dbname);

$valid_username="user";
$valid_password = "password";

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $input_username = $_POST['username'];
    $input_password = $_POST['password']; 


$stmt = $connection->prepare("SELECT * FROM login WHERE username = ? AND password = ?");


$stmt->bind_param("ss", $input_username, $input_password);

$stmt->execute();


$result = $stmt->get_result();


if($result->num_rows > 0){
 $_SESSION['username']=$input_username;
 header("location:storedb.php");
}   else{
echo "Invalid username or password.";
}
$stmt->close();

}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    login login
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>