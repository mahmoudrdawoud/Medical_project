<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            background-image: url("../imges/back.jpg");
            width: 100vw;
            height: 100vh;
            position: relative;
        }

        .container .con {
            width: 400px;
            background-color: #fff;
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            text-align: center;
            position: absolute;
            left: 40%;
            top: 35%;

        }

        h2 {
            color: #2a932e;
            margin-bottom: 25px;
            text-align: center;
            font-weight: bold;
            font-size: 30px;
        }

        .button {

            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 18px;
            margin: 5px;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="con">

            <h2>تسجيل الدخول</h2>
            <button class="button" onclick="login('admin')">طبيب</button>
            <button class="button" onclick="login('user')">مريض</button>

            <script>
                function login(role) {

                    sessionStorage.setItem('role', role);


                    if (role === 'admin') {
                        window.location.href = 'login.php';
                    } else if (role === 'user') {
                        window.location.href = 'specializations.php';
                    }
                }
            </script>
        </div>


    </div>



</body>

</html>