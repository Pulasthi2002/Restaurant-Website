<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "ouhotel";

$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$product_name = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: The_Outer_Clove_restaurant/Dashboard/manageItems.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: The_Outer_Clove_restaurant/Dashboard/manageItems.php");
        exit;
    }

    $product_name = $row["product_name"];

}

else{

    $id = $_POST["id"];
    $product_name = $_POST["pname"];

    do {
        if (empty($id) || empty($product_name)) {
            $errorMessage = "ALL FIELDS ARE REQUIRED";
            break;
        }

        $sql = "UPDATE products " .
        "SET product_name = '$product_name' " .
        "WHERE id = $id";

        $result = $connection->query($sql);
        
        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Item Updated Successfully";

        header("location: manageItems.php");
        exit;

    }while (false);

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ADD ITEMS </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: white;
            color: #fff;
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
    <a class="btn btn-primary back-button" href="manageItems.php">
        <i class="fas fa-arrow-left"></i> Back
    </a>

    <div class="container my-5">
        <h2>Add Item</h2>

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
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <label class="col-sm-3 col-form-label">Item Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="pname" value="<?php echo $product_name ?>">
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
                    <a class="btn btn-outline-primary" href="manageItems.php" role="button">Cancel</a>
                </div>
            </div>

        </form>

    </div>

</body>

</html>
