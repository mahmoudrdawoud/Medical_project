<?php
$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "medical";

// Create connection 
$conn = new mysqli($hostname, $username, $password, $db_name);
// Check connection 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM login";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Data</title>

    <style>
        /* CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-image: url("../imges/img12.jpg");
            width: 97vw;
            height: 100vh;
            background-size: cover;
        }

        h2 {
            text-align: center;
            padding: 30px;
        }

        table {
            width: 50%;
            border-collapse: collapse;
            margin: 0 auto;
        }

        tbody {
            background-color: #4d96b9;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #1badf3;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .no-data {
            text-align: center;
            font-weight: bold;
            color: #ff0000;
            margin-top: 20px;
        }



        .con {
            width: 98%;
            text-align: center;
            margin-bottom: 0px;
            position: absolute;
            bottom: 10px;
        }



        .button {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            width: 29%;
            padding: 10px;
            font-weight: bold;
            border: none;
            border-radius: 3px;
            font-weight: bold;
            padding: 10px;
            font-size: 20px;
            font-weight: bold;
        }

        .button:hover {
            background-color: #45a049;
        }

        a {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            width: 29%;
            padding: 7px;
            font-weight: bold;

            border: none;
            border-radius: 3px;
            font-weight: bold;
            padding: 10px;
            font-size: 15px;
            font-weight: bold;
        }
    </style>

</head>

<body>
    <h2>جدول بيانات المستخدمين</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table><tr><th>المعرّف</th><th>اسم المستخدم</th><th>كلمة المرور</th></tr>";
        // output data of each row 
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["username"] . "</td><td>" . $row["password"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "لا يوجد بيانات.";
    }
    $conn->close();
    ?>


    <div class="con">

        <button class="button" onclick="login('reports')">تقارير</button>
        <button class="button" onclick="login('managesdoctors')">إدارة الأطباء
        </button>
        <button class="button" onclick="login('managesAdmin')">إدارة التخصصات</button>

        <script>
            function login(role) {

                sessionStorage.setItem('role', role);

                if (role === 'managesdoctors') {
                    window.location.href = 'managesdoctors.php';
                } else if (role === 'reports') {
                    window.location.href = 'reports.php';
                } else if (role === 'managesAdmin') {
                    window.location.href = 'managesAdmin.php';
                }
            }
        </script>
    </div>

</body>

</html>