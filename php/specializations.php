<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            background-image: url("../imges/hag.jpg");
            width: 100vw;
            height: 100vh;
            background-size: cover;
        }


        .button {
            padding: 20px 30px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 20px;
            margin: 80px
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>


    <div class="container">

        <button class="button" onclick="login('user')">حجز موعد طبي</button>

        <script>
            function login(role) {

                window.location.href = 'appointment.php';

            }
        </script>


    </div>

</body>

</html>