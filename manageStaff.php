<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

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
        <h2> List Of Employees </h2>
            <a class="btn btn-primary" href="addStaff.php" role="button">Add Employee</a>
            <br>
            <table class="table">

                <thead>
                    <tr>
                        <th>id</th>
                        <th>fname</th>
                        <th>lname</th>
                        <th>username</th>
                        <th>email</th>
                        <th>contact</th>
                        <th>password</th>
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
                        
                        $sql = "SELECT * FROM staff";
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid query : " . $connection->error);

                        }

                        while ($row = $result->fetch_assoc()) {
                            echo "
                                <tr>
                                    <td>$row[id]</td>
                                    <td>$row[firstName]</td>
                                    <td>$row[lastName]</td>
                                    <td>$row[username]</td>
                                    <td>$row[email]</td>
                                    <td>$row[contactNo]</td>
                                    <td>$row[password]</td>
                                    <td>
                                        <a class='btn btn-primary btn-sm' href='editStaff.php?id=$row[id]'>Edit</a>
                                        <a class='btn btn-danger btn-sm' href='deleteStaff.php?id=$row[id]'>Delete</a>
                                    </td>
                                </tr>";
                        }
                        


                    ?>
                    
                </tbody>

            </table>

    </div>
    
</body>
</html>