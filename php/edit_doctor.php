<?php

$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "medical";

$con = mysqli_connect($hostname, $username, $password, $db_name);
if (mysqli_connect_errno()) {
    die("Failed to connect with MySQL: " . mysqli_connect_error());
}

$query = "SELECT * FROM doctors";
$result = mysqli_query($con, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_doctor'])) {
    $doctorId = $_POST['doctor_id'];
    $doctorName = $_POST['doctor_name'];

    $query = "UPDATE doctors SET name = '$doctorName' WHERE id = '$doctorId'";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<script>
                alert('تم تحديث الطبيب بنجاح.');
                window.location.href = 'managesdoctors.php';
            </script>";
    } else {
        echo "فشل في تحديث الطبيب.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل الطبيب</title>
</head>

<style>
    body {
        background-color: #4b5ba3;
    }

    h2 {
        color: white;
    }

    .container {
        width: 20%;
        margin: 100px auto;
        text-align: center;
        height: 100px;
        padding: 20px;
    }

    button {
        font-weight: bold;
        background-color: #0da70d;
        font-size: 15px;
        color: white;
    }

    input {
        font-size: 15px;
    }
</style>

<body>
    <div class="container">
        <div class="section">
            <h2>تعديل الطبيب</h2>
            <?php
            // فحص إذا كانت الصفحة تستقبل معرف الطبيب
            if (isset($_GET['id'])) {
                $doctorId = $_GET['id'];

                // استعلام لجلب بيانات الطبيب من قاعدة البيانات
                $query = "SELECT * FROM doctors WHERE id = '$doctorId'";
                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $doctorName = $row['name'];
                } else {
                    die("لم يتم العثور على الطبيب.");
                }
            } else {
                die("معرف الطبيب غير محدد.");
            }
            ?>

            <form name="editDoctorForm" action="" method="POST">
                <input type="hidden" name="doctor_id" value="<?php echo $doctorId; ?>">
                <input type="text" name="doctor_name" placeholder="اسم الطبيب" value="<?php echo $doctorName; ?>" required>
                <button type="submit" name="edit_doctor">تحديث</button>
            </form>
        </div>
    </div>
</body>

</html>

<?php
mysqli_close($con);
?>