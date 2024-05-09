<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ouhotel";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO admin (fullname, email, contact_no, username, password) 
            VALUES ('$fullname', '$email', '$contactNo', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        $response = ['success' => true, 'message' => 'Admin registered successfully'];
    } else {
        $response = ['success' => false, 'message' => 'Error registering admin'];
    }

    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

?>
