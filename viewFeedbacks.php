<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedbacks</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            color: #050505;
            background-color: #faf9f7 ;
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
        <h2>Feedbacks</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>message</th>
                    <th>Action</th>
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
                
                $sql = "SELECT * FROM userfb";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query : " . $connection->error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>$row[id]</td>
                            <td>$row[fullName]</td>
                            <td>$row[email]</td>
                            <td>$row[message]</td>
                            <td>
                                <a class='btn btn-danger btn-sm' href='deletefb.php?id=$row[id]'>Delete</a>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>
