<?php

$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "medical";

$con = mysqli_connect($hostname, $username, $password, $db_name);
if (mysqli_connect_errno()) {
    die("Failed to connect with MySQL: " . mysqli_connect_error());
}

$query = "SELECT * FROM specializations";
$result = mysqli_query($con, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_specialization'])) {
    $specializationId = $_POST['specialization_id'];
    $specializationName = $_POST['specialization_name'];

    $query = "UPDATE specializations SET name = '$specializationName' WHERE id = '$specializationId'";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<script>
                alert('تم تحديث التخصص بنجاح.');
                window.location.href = 'managesAdmin.php';
            </script>";
    } else {
        echo "فشل في تحديث التخصص.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل التخصص</title>


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
            <h2>تعديل التخصص</h2>
            <?php
            // فحص إذا كانت الصفحة تستقبل معرف التخصص
            if (isset($_GET['id'])) {
                $specializationId = $_GET['id'];

                // استعلام لجلب بيانات التخصص من قاعدة البيانات
                $query = "SELECT * FROM specializations WHERE id = '$specializationId'";
                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $specializationName = $row['name'];
                } else {
                    die("لم يتم العثور على التخصص.");
                }
            } else {
                die("معرف التخصص غير محدد.");
            }
            ?>

            <form name="editSpecializationForm" action="" method="POST">
                <input type="hidden" name="specialization_id" value="<?php echo $specializationId; ?>">
                <input type="text" name="specialization_name" placeholder="اسم التخصص" value="<?php echo $specializationName; ?>" required>
                <button type="submit" name="edit_specialization">تحديث</button>
            </form>
        </div>
    </div>
</body>

</html>

<?php

mysqli_close($con);

?>