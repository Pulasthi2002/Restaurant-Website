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
        <h2>Reservations</h2>
            
            <br>
            <table class="table">

                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>address</th>
                        <th>phone</th>
                        <th>email</th>
                        <th>reservation_date</th>
                        <th>reservation_time</th>
                        <th>Persons</th>
                        <th>tableNo</th>
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
                        
                        $sql = "SELECT * FROM reservations";
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid query : " . $connection->error);

                        }

                        while ($row = $result->fetch_assoc()) {
                            echo "
                                <tr>
                                    <td>$row[id]</td>
                                    <td>$row[customer_name]</td>
                                    <td>$row[address]</td>
                                    <td>$row[contact_number]</td>
                                    <td>$row[email]</td>
                                    <td>$row[reservation_date]</td>
                                    <td>$row[reservation_time]</td>
                                    <td>$row[num_attendees]</td>
                                    <td>$row[table_number]</td>
                                    <td>
                                        <a class='btn btn-primary btn-sm' href='editres.php?id=$row[id]'>Edit</a>
                                        <a class='btn btn-danger btn-sm' href='deleteres.php?id=$row[id]'>Delete</a>
                                    </td>
                                </tr>";
                        }
                        


                    ?>
                    
                </tbody>

            </table>

    </div>
    
    
</body>
</html>