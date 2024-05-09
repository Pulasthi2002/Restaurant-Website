<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background:  #faf9f7;
            color: #fff;
            margin: 0;
            display: flex;
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
    <a class="btn btn-primary back-button" href="staffHome.html">
        <i class="fas fa-arrow-left"></i> Back
    </a>

    <div class="container my-5">
        <h2> Orders </h2>
            <br>
            <table class="table">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Food Item</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "ouhotel";

                        $connection = new mysqli($servername,$username,$password,$database);

                        if ($connection->connect_error) {
                            die("Connection failed: " . $connection->connect_error);
                        }
                        
                        $sql = "SELECT * FROM orders";
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid query : " . $connection->error);

                        }

                        while ($row = $result->fetch_assoc()) {
                            echo "
                                <tr>
                                    <td>$row[id]</td>
                                    <td>$row[customer_name]</td>
                                    <td>$row[customer_email]</td>
                                    <td>$row[customer_phone]</td>
                                    <td>$row[address]</td>
                                    <td>$row[item_name]</td>
                                    <td>$row[quantity]</td>
                                </tr>";
                        }
                        


                    ?>
                    
                </tbody>

            </table>

    </div>
    
</body>
</html>