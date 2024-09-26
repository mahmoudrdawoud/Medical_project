        <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

        <?php
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $db_name = "medical";

        $con = mysqli_connect($hostname, $username, $password, $db_name);
        if (mysqli_connect_errno()) {
            die("Failed to connect with MySQL: " . mysqli_connect_error());
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_appointment'])) {
            $patientName = $_POST['patient_name'];
            $patientID = $_POST['patient_id'];
            $complaint = $_POST['complaint'];
            $specialization = $_POST['specialization'];

            $query = "INSERT INTO appointments (patient_name, patient_id, complaint, specialization_id) VALUES ('$patientName', '$patientID', '$complaint', '$specialization')";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo "تم حجز الموعد بنجاح.";
                // إعادة تحميل الصفحة بعد ثانية واحدة (أو أي فترة زمنية تفضلها)
                header("refresh:1");
            } else {
                echo "فشل في حجز الموعد.";
            }
        }
        ?>
        <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

        <!DOCTYPE html>
        <html lang="en" dir="rtl">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>عرض موعد </title>

            <!-- <link rel="stylesheet" href="../Css/index.css"> -->
        </head>
        <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
                text-align: center;

            }

            .cont {
                margin: 30px auto;
                width: 25%;
                text-align: center;
                position: absolute;
            }

            .contab {
                width: 50%;
                text-align: center;
                margin: 0 auto;
            }

            .button {
                padding: 10px 20px;
                background-color: #4caf50;
                color: #fff;
                border: none;
                border-radius: 3px;
                cursor: pointer;
            }

            .button:hover {
                background-color: #45a049;
            }

            .container .cont form div {
                margin: 15px;
            }


            .container .cont {
                text-align: center;
                margin-top: 20px;
                margin-bottom: 20px;
                background-color: #f4f4f4;
                border-radius: 10px;
                top: 124px;
                left: 700px;
                padding: 20px;
            }

            .container .cont form div label {
                padding: 10px;
                font-size: 15px;
                font-weight: bold;

            }

            .container .cont form div input,
            .container .cont form div textarea,
            .container .cont form div select {
                padding: 6px;
                border: 2px dashed;
            }

            .container .cont form div select {
                width: 42%;
                margin-left: 70px;
            }

            .container .cont form {
                padding: 10px;
            }



            .container {
                background-image: url("../imges/ss.jpg");
                width: 100vw;
                height: 100vh;
                position: relative;
                background-size: cover;
            }

            button {
                padding: 13px 13px;
                background-color: #4caf50;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-weight: bold;
                font-size: 15px;
                margin: 5px;
                margin-left: 14px;
            }

            button:hover {
                background-color: #45a049;
            }
        </style>
        <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

        <body>

            <div class="container">





                <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

                <div class="cont">

                    <h1>حجز موعد طبي</h1>
                    <form method="POST" action="">

                        <div>

                            <label>اسم المريض</label>
                            <input type="text" name="patient_name" required><br>
                        </div>

                        <div>
                            <label>رقم الهوية</label>
                            <input type="text" name="patient_id" required style="margin-right: 10px;"><br>
                        </div>

                        <div>
                            <label style="position: relative;bottom: 20px;">الشكوى</label>
                            <textarea name="complaint" required style="margin-right: 18px;"></textarea><br>
                        </div>

                        <div style="display:flex;flex-wrap: nowrap;justify-content: space-evenly;align-items: center;">
                            <label style="margin-right: 60px;">اختر التخصص</label>
                            <select name="specialization">

                                <?php
                                $query = "SELECT * FROM specializations";
                                $result = mysqli_query($con, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $specializationId = $row['id'];
                                    $specializationName = $row['name'];
                                    echo "<option value='$specializationId'>$specializationName</option>";
                                }
                                ?>
                            </select><br>


                        </div>
                        <button type="submit" name="submit_appointment">حجز الموعد</button>
                    </form>
                </div>
                <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

                <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->




            </div>
        </body>

        </html>

        <?php
        mysqli_close($con);
        ?>