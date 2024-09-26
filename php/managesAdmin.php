<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<?php
$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "medical";

$con = new mysqli($hostname, $username, $password, $db_name);
if (mysqli_connect_errno()) {
    die("Failed to connect with MySQL: " . mysqli_connect_error());
}

// إضافة تخصص جديد
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_specialization'])) {
    $specialization = $_POST['specialization'];

    $query = "INSERT INTO specializations (name) VALUES ('$specialization')";
    $result = mysqli_query($con, $query);

    if ($result) {
        //echo "تمت إضافة التخصص بنجاح.";
    } else {
        // echo "فشل في إضافة التخصص.";
    }
}


// حذف تخصص
if (isset($_GET['delete_specialization'])) {
    $specializationId = $_GET['delete_specialization'];

    // حذف الاستشارات المرتبطة بالتخصص أولاً
    $deleteAppointmentsQuery = "DELETE FROM appointments WHERE specialization_id = '$specializationId'";
    $deleteAppointmentsResult = mysqli_query($con, $deleteAppointmentsQuery);

    // التحقق من نجاح عملية حذف الاستشارات
    if ($deleteAppointmentsResult) {
        // حذف التخصص بعد حذف الاستشارات المرتبطة به
        $deleteSpecializationQuery = "DELETE FROM specializations WHERE id = '$specializationId'";
        $deleteSpecializationResult = mysqli_query($con, $deleteSpecializationQuery);

        if ($deleteSpecializationResult) {
            echo "تم حذف التخصص بنجاح.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "فشل في حذف التخصص.";
        }
    } else {
        echo "فشل في حذف الاستشارات المرتبطة بالتخصص.";
    }
}



?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->


<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical System</title>
</head>
<link rel="stylesheet" href="../Css/manage.css">
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        text-align: center;
    }

    .container .section {
        width: 100%;
        margin-top: 0px;
    }


    .co {
        background-image: url("../imges/tkh.jpg");
        width: 100vw;
        height: 100vh;
        background-size: cover;
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

<body>

    <div class="co">


        <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

        <div class="container">
            <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
            <div class="section">
                <h2 style="text-align: center;">إدارة التخصصات</h2>
                <form name="specializationForm" action="" method="POST">
                    <input type="text" name="specialization" placeholder="اسم التخصص" required>
                    <button type="submit" name="add_specialization">إضافة</button>
                </form>
                <table>
                    <tr>
                        <th>اسم التخصص</th>
                        <th>الإجراءات</th>
                    </tr>
                    <!-- استعراض التخصصات من قاعدة البيانات -->
                    <?php
                    $query = "SELECT * FROM specializations";
                    $result = mysqli_query($con, $query);

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
                    ?>
                </table>
                <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

            </div>
            <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

        </div>


        <div class="con">

            <button class="button" onclick="login('reports')">تقارير</button>
            <button class="button" onclick="login('managesdoctors')">إدارة الأطباء
            </button>
            <button class="button" onclick="login('search_specialization')">بحث عن تخصص</button>

            <script>
                function login(role) {

                    sessionStorage.setItem('role', role);

                    if (role === 'managesdoctors') {
                        window.location.href = 'managesdoctors.php';
                    } else if (role === 'reports') {
                        window.location.href = 'reports.php';
                    } else if (role === 'search_specialization') {
                        window.location.href = 'search_specialization.php';
                    }
                }
            </script>
        </div>

        <script>
            function confirmDelete(specializationId) {
                if (confirm("هل أنت متأكد من حذف التخصص؟")) {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            location.reload();
                        }
                    };
                    xhttp.open("GET", "?delete_specialization=" + specializationId, true);
                    xhttp.send();
                }
            }
        </script>
        <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

    </div>

</body>

</html>


<?php
mysqli_close($con);
?>