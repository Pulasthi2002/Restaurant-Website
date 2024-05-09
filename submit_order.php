<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ouhotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerName = $_POST["customerName"];
    $customerEmail = $_POST["customerEmail"];
    $customerPhone = $_POST["customerPhone"];
    $customerAddress = $_POST["address"];
    $foodItem = $_POST["foodItem"];
    $quantity = $_POST["quantity"];

    $sql = "INSERT INTO orders (customer_name, customer_email, customer_phone, address, item_name, quantity) VALUES ('$customerName', '$customerEmail', '$customerPhone', '$customerAddress', '$foodItem', '$quantity')";

    if ($conn->query($sql) === TRUE) {
        $response = array("success" => true, "message" => "Order placed successfully");
    } else {
        $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
    }

    echo json_encode($response);
} else {
    // If not a POST request, handle accordingly
    echo json_encode(array("success" => false, "message" => "Invalid request method"));
}

$conn->close();
?>
