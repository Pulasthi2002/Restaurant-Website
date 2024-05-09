<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ouhotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, product_name FROM products";
$result = $conn->query($sql);

$foodItems = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $foodItems[] = $row;
    }
}

echo json_encode($foodItems);

$conn->close();
?>
