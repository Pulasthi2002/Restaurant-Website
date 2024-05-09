<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "hotel";


$conn = new mysqli($servername,$username,$password,$database);

if($conn->connect_error){
    die("Connection Failed;".conn->connect_error);
}


if($_SERVER ["REQUEST_METHOD"]=="POST"){
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $address = $_POST["addres"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $username = $_POST["username"];
    $password = $_POST["pass"];


    $sql = "INSERT INTO signup(firstName, lastName, addres, telephone, email, gender, username, pass) VALUES ("sssssssss", $firstName, $lastName, $address, $telephone, $email, $gender, $username, $password)";

    if($conn->query($sql)===TRUE){
        echo "New record created succesfully";

    }else{
        echo "Error",$sql."<br>".conn->error;
    }

}

$conn->close();

?>