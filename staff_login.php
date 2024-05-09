<?php

$host = "localhost"; 
$username = "root";
$password = "";
$database = "ouhotel";

$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function processLogin($conn, $username, $password) {

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);


    $query = "SELECT * FROM staff WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        
        header("Location: staffHome.html");
        exit(); 
    } else {
        return "Invalid username or password.";
    }
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginResult = processLogin($conn, $username, $password);

    echo $loginResult;
}

$conn->close();
?>
