<?php
$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "medical";

$con = new mysqli($hostname, $username, $password, $db_name);
if (mysqli_connect_errno()) {
    die("Failed to connect with MySQL: " . mysqli_connect_error());
}
?>



<!DOCTYPE html>


<html>


<head>

    <link rel="stylesheet" href="../Css/manage.css">
    <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #128f5f;
            margin: 0;
            padding: 0;
            text-align: center;
            background-image: url("../imges/img15.jpg");
            width: 97vw;
            height: 100vh;
            background-size: cover;
        }

        .section {
            width: 50%;
            margin: 5% 25%;
            padding: 40px;
        }

        .con {
            width: 100%;
            text-align: center;
            margin-bottom: 0px;
            position: absolute;
            bottom: 10px;
        }

        form button {
            color: #fff;
            cursor: pointer;
            width: 29%;
            padding: 7px;
            font-weight: bold;
            border: none;
            border-radius: 3px;
            font-weight: bold;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
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
    <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

</head>

<body>



    <div class="section">
        <h2 style="text-align: center;">بحث عن التخصصات</h2>
        <form name="searchForm" action="" method="GET">
            <input type="text" name="search_query" placeholder="ابحث عن التخصص">
            <button type="submit">بحث</button>
        </form>
        <?php
        if (isset($_GET['search_query'])) {
            $searchQuery = $_GET['search_query'];

            $query = "SELECT * FROM specializations WHERE name LIKE '%$searchQuery%'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                echo "<table>
                            <tr>
                                <th>اسم التخصص</th>
                                <th>الإجراءات</th>
                            </tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    $specializationId = $row['id'];
                    $specializationName = $row['name'];
                    echo "<tr>
                                <td>$specializationName</td>
                                    <td>
                                        <a href='edit_specialization.php?id=$specializationId'>تعديل</a>
                                        <a href='?delete_specialization=$specializationId'>حذف</a>
                                   </td>
                            </tr>";
                }

                echo "</table>";
            } else {
                echo "لا يوجد نتائج للبحث.";
            }
        }
        ?>
    </div>
    <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
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