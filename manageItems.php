<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Items</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #ffffff;
            color: #050505;
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
    <a class="btn btn-primary back-button" href="admin_home.html">
        <i class="fas fa-arrow-left"></i> Back
    </a>

    <div class="container my-5">
        <h2> Items </h2>
            <a class="btn btn-primary" href="addItems.php" role="button">ADD Items</a>
            <br>
            <table class="table">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "Ouhotel";

                        $connection = new mysqli($servername,$username,$password,$database);

                        if ($connection->connect_error) {
                            die("Connection failed: " . $connection->connect_error);
                        }
                        
                        $sql = "SELECT * FROM products";
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid query : " . $connection->error);

                        }

                        while ($row = $result->fetch_assoc()) {
                            echo "
                                <tr>
                                    <td>$row[id]</td>
                                    <td>$row[product_name]</td>
                                    <td>
                                        <a class='btn btn-primary btn-sm' href='editItems.php?id=$row[id]'>Edit</a>
                                        <a class='btn btn-danger btn-sm' href='deleteItems.php?id=$row[id]'>Delete</a>
                                    </td>
                                </tr>";
                        }
                        


                    ?>
                    
                </tbody>

            </table>

    </div>
    
</body>
</html>