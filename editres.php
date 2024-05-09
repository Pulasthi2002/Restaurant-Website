<?php

$servername = "localhost";
$person = "root";
$message= "";
$database = "ouhotel";

$connection = new mysqli($servername, $person, $message, $database);

$id = "";
$name = "";
$address = "";
$phone = "";
$email = "";
$reservation_date = "";
$reservation_time = "";
$persons = "";
$tableNo = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: res.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM reservations WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: res.php");
        exit;
    }

    $name = $row["customer_name"];
    $address = $row["address"];
    $phone = $row["contact_number"];
    $email = $row["email"];
    $reservation_date = $row["reservation_date"];
    $reservation_time = $row["reservation_time"];
    $persons= $row["num_attendees"];
    $tableNo= $row["table_number"];

}

else{

    $id = $_POST["id"];
    $name = $_POST["customer_name"];
    $address = $_POST["address"];
    $phone = $_POST["contact_number"];
    $email = $_POST["email"];
    $reservation_date = $_POST["reservation_date"];
    $reservation_time = $_POST["reservation_time"];
    $persons = $_POST["num_attendees"];
    $tableNo= $_POST["table_number"];

    do {
        if (empty($id) || empty($name) || empty($address) || empty($phone) || empty($email) || empty($reservation_date) || empty($reservation_time) || empty($persons) || empty($tableNo)) {
            $errorMessage = "ALL FIELDS ARE REQUIRED";
            break;
        }

        $sql = "UPDATE reservations " .
        "SET name = '$name', address = '$address', phone = '$phone',  email = '$email',  reservation_date = '$reservation_date', reservation_time = '$reservation_time', person = '$persons', tableNo = '$tableNo' " .
        "WHERE id = $id";

        $result = $connection->query($sql);
        
        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Reservation Updated Successfully";

        header("location: res.php");
        exit;

    }while (false);

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD USER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #faf9f7 ;
            color: #050505;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .back-button {
            position: fixed;
            top: 20px;
            left: 20px;
        }

    </style>

</head>

<body>
    <a class="btn btn-primary back-button" href="res.php">
        <i class="fas fa-arrow-left"></i> Back
    </a>

    <div class="container my-5">
        <h2>Reservations</h2>

        <?php

        if (!empty($errorMessage)) {

            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>
            ";
        }

        ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                <input type="text" name="customer_name" value="<?php echo $row['customer_name']; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                <input type="text" name="address" value="<?php echo $row['address']; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                <input type="text" name="contact_number" value="<?php echo $row['contact_number']; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">EmaIL</label>
                <div class="col-sm-6">
                <input type="text" name="email" value="<?php echo $row['email']; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Reservation Date</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="reservation_date" value="<?php echo $reservation_date ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Reservation Time</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="reservation_time" value="<?php echo $reservation_time ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Persons</label>
                <div class="col-sm-6">
                <input type="text" name="num_attendees" value="<?php echo $row['num_attendees']; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Table No</label>
                <div class="col-sm-6">
                <input type="text" name="table_number" value="<?php echo $row['table_number']; ?>">
                </div>
            </div>

            <?php

            if (!empty($successMessage)) {

                echo "
                    <div class='row mb-3'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                        </div>
                    </div>
                    ";
            }

            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="res.php" role="button">Cancel</a>
                </div>
            </div>

        </form>

    </div>

</body>

</html>
