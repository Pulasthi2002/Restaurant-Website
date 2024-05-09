<?php

$servername = "localhost";
$username = "root";
$quantity = "";
$database = "ouhotel";

$connection = new mysqli($servername, $username, $quantity, $database);

$id = "";
$customer_name = "";
$email = "";
$contact = "";
$address = "";
$item_name = "";
$quantity = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: The_Outer_Clove_restaurant/Dashboard/manageOrder.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM orders WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: The_Outer_Clove_restaurant/Dashboard/manageOrder.php");
        exit;
    }

    $customer_name = $row["customer_name"];
    $email = $row["customer_email"];
    $contact = $row["customer_phone"];
    $address = $row["address"];
    $item_name = $row["item_name"];
    $quantity = $row["quantity"];

}

else{

    $id = $_POST["id"];
    $customer_name = $_POST["cname"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $address= $_POST["address"];
    $item_name = $_POST["itemname"];
    $quantity = $_POST["quantity"];

    do {
        if (empty($id) || empty($customer_name) || empty($email) || empty($contact) || empty($address) || empty($item_name) || empty($quantity)) {
            $errorMessage = "ALL FIELDS ARE REQUIRED";
            break;
        }

        $sql = "UPDATE orders " .
        "SET customer_name = '$customer_name', customer_email = '$email', customer_phone = '$contact', address = '$address', item_name = '$item_name', quantity = '$quantity' " .
        "WHERE id = $id";

        $result = $connection->query($sql);
        
        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Order Details Updated Successfully";

        header("location: manageOrder.php");
        exit;

    }while (false);

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Edit ORDERS </title>
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
    <a class="btn btn-primary back-button" href="manageOrder.php">
        <i class="fas fa-arrow-left"></i> Back
    </a>

    <div class="container my-5">
        <h2>Place Order</h2>

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
                <label class="col-sm-3 col-form-label">Customer Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="cname" value="<?php echo $customer_name ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Contact Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="contact" value="<?php echo $contact ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Food Item</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="itemname" value="<?php echo $item_name ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Quantity</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="quantity" value="<?php echo $quantity ?>">
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
                    <a class="btn btn-outline-primary" href="manageOrder.php" role="button">Cancel</a>
                </div>
            </div>

        </form>

    </div>

</body>

</html>

