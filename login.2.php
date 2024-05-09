<?php

$conn = mysqli_connect('localhost','root','','ouhotel');


    $username = $_GET['username'];
    $password = $_GET['pass'];

    $query = "SELECT * FROM signup WHERE username = ? AND pass=?";
    $stm = $conn->prepare($query);
    $stm->bind_param("ss", $username, $password);
    $stm->execute();
    $result = $stm->get_result();
   

    if ($username === $correctUsername && $password === $correctPassword) {
        echo '<script>window.location.href = "userhome.html";</script>';
    } else {
        echo "Invalide username or password. please try again";
    }
$stmt->close();
$conn->close();

?>