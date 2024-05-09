<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ouhotel";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];
    $num_attendees = $_POST['num_attendees'];

    $table_number = mt_rand(1, 100);

    $sql = "INSERT INTO reservations (customer_name, address, contact_number, email, reservation_date, reservation_time, num_attendees, table_number)
        VALUES ('$customer_name', '$address', '$contact_number', '$email', '$reservation_date', '$reservation_time', '$num_attendees', '$table_number')";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Error: ' . $sql . '<br>' . $conn->error));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}
?>
