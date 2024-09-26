        <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

        <?php
        session_start();

        $hostname = "localhost";
        $username = "root";
        $password = "";
        $db_name = "medical";

        $con = mysqli_connect($hostname, $username, $password, $db_name);
        if (mysqli_connect_errno()) {
            die("Failed to connect with MySQL: " . mysqli_connect_error());
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['name'];
            $password = $_POST['password'];

            $query = "INSERT INTO login (username, password) VALUES ('$username', '$password')";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo "تم إنشاء الحساب بنجاح.";
                header("Location: login.php");
            } else {
                echo "حدث خطأ أثناء إنشاء الحساب.";
            }
        }

        mysqli_close($con);
        ?>
        <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

        <!DOCTYPE html>
        <html lang="en" dir="rtl">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>إنشاء حساب جديد</title>
            <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }

                .container {
                    width: 400px;
                    background-color: #fff;
                    padding: 40px 20px;
                    border-radius: 5px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
                    position: absolute;
                    left: 300px;
                    top: 200px;
                }

                .container h2 {
                    text-align: center;
                    margin-bottom: 20px;
                }

                .container input[type="text"],
                .container input[type="password"],
                .container input[type="submit"] {
                    width: 94%;
                    padding: 10px;
                    margin-bottom: 10px;
                    border-radius: 3px;
                    border: 1px solid #ccc;
                }

                .container input[type="submit"] {
                    background-color: #4caf50;
                    color: #fff;
                    cursor: pointer;
                    width: 100%;
                    font-size: 15px;
                    font-weight: bold;
                }

                .container input[type="submit"]:hover {
                    background-color: #45a049;
                }

                .container p {
                    text-align: center;
                }

                .container p a {
                    color: #4caf50;
                }

                .con {
                    background-image: url("../imges/new.jpg");
                    width: 100vw;
                    height: 100vh;
                    position: relative;
                    background-size: cover
                }
            </style>
            <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

        </head>

        <body>
            <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

            <div class="con">
                <div class="container">

                    <h2>إنشاء حساب جديد</h2>
                    <form method="POST" action="">
                        <input type="text" name="name" placeholder="اسم المستخدم" required>
                        <input type="password" name="password" placeholder="كلمة المرور" required>
                        <input type="submit" value="إنشاء الحساب">
                    </form>
                    <p>لديك حساب بالفعل؟ <a href="login.php">تسجيل الدخول</a></p>
                </div>

            </div>
            <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

        </body>

        </html>