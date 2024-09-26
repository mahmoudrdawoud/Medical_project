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

// عملية حذف المريض إذا تم النقر على زر الحذف
if (isset($_GET['delete_patient'])) {
    $patientIDToDelete = $_GET['delete_patient'];

    // قم بكتابة استعلام SQL لحذف المريض من جدول المواعيد
    $deleteQuery = "DELETE FROM appointments WHERE patient_id = '$patientIDToDelete'";
    $deleteResult = $conn->query($deleteQuery);

    if ($deleteResult) {
        echo "تم حذف المريض بنجاح.";
        header("Location: reports.php"); // إعادة تحميل الصفحة بدون المعرّف ?delete_patient=رقم_الهوية
        exit(); // التأكد من عدم استمرار التنفيذ بعد استدعاء الـ header
    } else {
        echo "فشل في حذف المريض.";
    }
}
// استعلام لاسترجاع بيانات المواعيد
$sql = "SELECT * FROM appointments";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة المرضى</title>

    <style>
        /* CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-image: url("../imges/img14.jpg");
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
            background-color: #1badf3;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #28cee6;
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
    <h2>قائمة المرضى</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table><tr><th>رقم الهوية</th><th>اسم المريض</th><th>الشكوى</th><th>الاجراءات</th></tr>";
        // output data of each row 
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["patient_id"] . "</td><td>" . $row["patient_name"] . "</td><td>" . $row["complaint"] . "</td><td><a href='?delete_patient=" . $row["patient_id"] . "'>حذف</a></td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='no-data'>لا يوجد بيانات.</p>";
    }
    $conn->close();
    ?>

    <div class="con">
        <button class="button" onclick="login('profile')">بيانات الموظفين</button>
        <button class="button" onclick="login('managesdoctors')">إدارة الأطباء</button>
        <button class="button" onclick="login('managesAdmin')">إدارة التخصصات</button>

        <script>
            function login(role) {

                sessionStorage.setItem('role', role);

                if (role === 'managesdoctors') {
                    window.location.href = 'managesdoctors.php';
                } else if (role === 'profile') {
                    window.location.href = 'profile.php';
                } else if (role === 'managesAdmin') {
                    window.location.href = 'managesAdmin.php';
                }
            }
        </script>
    </div>
</body>

</html>