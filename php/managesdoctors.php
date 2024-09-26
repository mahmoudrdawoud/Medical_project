<?php
$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "medical";

$con = mysqli_connect($hostname, $username, $password, $db_name);
if (mysqli_connect_errno()) {
    die("Failed to connect with MySQL: " . mysqli_connect_error());
}

// إضافة طبيب جديد
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_doctor'])) {
    $doctorName = $_POST['doctor_name'];
    $doctorSpecialization = $_POST['doctor_specialization'];

    $query = "INSERT INTO doctors (name, specialization_id) VALUES ('$doctorName', '$doctorSpecialization')";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "تمت إضافة الطبيب بنجاح.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "فشل في إضافة الطبيب.";
    }
}

// حذف طبيب
if (isset($_GET['delete_doctor'])) {
    $doctorId = $_GET['delete_doctor'];

    $query = "DELETE FROM doctors WHERE id = '$doctorId'";
    $result = mysqli_query($con, $query);

    // التحقق من نجاح عملية حذف الاستشارات
    if ($result) {
        echo "تم حذف الطبيب بنجاح.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "فشل في حذف الطبيب.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical System</title>
</head>
<link rel="stylesheet" href="../Css/manage.css">

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        text-align: center;
        background-image: url("../imges/img13.jpg");
        width: 97vw;
        height: 100vh;
        background-size: cover;
    }

    .container {
        padding: 0;
        margin: 0;


    }

    .container .section {
        width: 100%;
        margin-top: 0px;
        margin: 5% 30%;
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

<body>
    <div class="container">

        <div class="section">
            <h2>إدارة الأطباء</h2>
            <form name="doctorForm" action="" method="POST">
                <input type="text" name="doctor_name" placeholder="اسم الطبيب" required>
                <select name="doctor_specialization" required>
                    <option value="" disabled selected>اختر التخصص</option>
                    <!-- استعراض التخصصات من قاعدة البيانات -->
                    <?php
                    $query = "SELECT * FROM specializations";
                    $result = mysqli_query($con, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $specializationId = $row['id'];
                        $specializationName = $row['name'];
                        echo "<option value='$specializationId'>$specializationName</option>";
                    }
                    ?>
                </select>
                <button type="submit" name="add_doctor">إضافة</button>
            </form>
            <table>
                <tr>
                    <th>اسم الطبيب</th>
                    <th>التخصص</th>
                    <!-- <th>الإجراءات</th> -->
                </tr>
                <!-- استعراض الأطباء من قاعدة البيانات -->
                <?php
                $query = "SELECT doctors.*, specializations.name AS specialization_name 
          FROM doctors INNER JOIN specializations 
          ON doctors.specialization_id = specializations.id";
                $result = mysqli_query($con, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    $doctorId = $row['id'];
                    $doctorName = $row['name'];
                    $specializationName = $row['specialization_name'];
                    echo "<tr>
        <td>$doctorName</td>
        <td>$specializationName</td>
       
      </tr>";
                }
                ?>
            </table>
        </div>
        <!-- 

            <td>
            <a href='edit_doctor.php?id=$doctorId'>تعديل</a>
             Add the delete confirmation here 
        <a href='javascript:void(0);' onclick='confirmDelete($doctorId)'>حذف</a>
        </td>

            -->
        <div class="con">

            <button class="button" onclick="login('reports')">تقارير</button>
            <button class="button" onclick="login('search_specialization')">بحث عن تخصص</button>
            <button class="button" onclick="login('managesAdmin')">إدارة التخصصات</button>

            <script>
                function login(role) {

                    sessionStorage.setItem('role', role);

                    if (role === 'search_specialization') {
                        window.location.href = 'search_specialization.php';
                    } else if (role === 'reports') {
                        window.location.href = 'reports.php';
                    } else if (role === 'managesAdmin') {
                        window.location.href = 'managesAdmin.php';
                    }
                }
            </script>
        </div>

    </div>

    <script>
        function confirmDelete(doctorId) {
            if (confirm("هل أنت متأكد من حذف الطبيب؟")) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        location.reload();
                    }
                };
                xhttp.open("GET", "?delete_doctor=" + doctorId, true);
                xhttp.send();
                deleteLink.style.pointerEvents = "none";

            }
        }
    </script>

</body>

</html>

<?php
mysqli_close($con);
?>