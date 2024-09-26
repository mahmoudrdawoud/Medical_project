<?php
session_start();

$hostname = "localhost";
$username = "root";
$password = '';
$db_name = "medical";

$con = mysqli_connect($hostname, $username, $password, $db_name);

if (mysqli_connect_errno()) {
	die("Failed to connect with MySQL: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $_POST['user'];
	$password = $_POST['pass'];

	$query = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
	$result = mysqli_query($con, $query);
	$count = mysqli_num_rows($result);

	if ($count == 1) {
		$_SESSION['username'] = $username;
		header("Location: managesAdmin.php");
		exit();
	} else {
		//echo "Error username or password.";
	}
}

mysqli_close($con);
?>


<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link rel="stylesheet" href="../css/login.css">
</head>

<style>
	body {
		font-family: Arial, sans-serif;
		background-color: #f4f4f4;
		margin: 0;
		padding: 0;
		text-align: center;
	}


	.container {
		width: 400px;
		background-color: #fff;
		padding: 30px;
		border-radius: 5px;
		box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
		position: absolute;
		left: 60%;
		top: 20%;

	}

	div img {
		width: 40%;
		text-align: center;
		margin: 0 auto;
		margin-bottom: 15px;
	}

	img {
		width: 50%;
	}

	.container h2 {
		text-align: center;
		margin-bottom: 20px;
	}

	.container input[type="submit"] {
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

	.container input[type="submit"]:hover {
		background-color: #45a049;
	}

	.container div {
		text-align: center;
	}

	.container form div {
		margin: 15px;
	}

	.container form div label {
		padding: 10px;
		font-size: 15px;
		font-weight: bold;

	}

	.container form div input {
		padding: 6px;
		border: 2px dashed;
	}

	.container form {
		padding: 10px;
	}

	.container p a {
		color: #4caf50;
	}


	.con {
		background-image: url("../imges/doc.jpg");
		width: 100vw;
		height: 100vh;
		position: relative;
		background-size: cover
	}
</style>


<body>

	<div class="con">

		<div class="container">


			<div>
				<img src="../imges/fff.png" alt="">
			</div>
			<div id="frm">
				<form name="f1" action="" onsubmit="return validation()" method="POST">
					<div>
						<label> اسم المستخدم </label>
						<input type="text" id="user" name="user" value="" />
					</div>
					<div>
						<label> كلمة السر </label>
						<input type="password" id="pass" name="pass" style="margin-right: 18px;" />
					</div>
					<div>
						<input type="submit" id="btn" value="تسجيل دخول" />
					</div>
				</form>
				<p>ليس لديك حساب؟ <a href="signup.php">إنشاء حساب جديد</a></p>
			</div>
			<img src="../imges/img1.jpg" alt="">
		</div>
	</div>

	<script>
		function validation() {
			var id = document.f1.user.value;
			var ps = document.f1.pass.value;
			if (id.length == "" && ps.length == "") {
				alert("User Name and Password fields are empty");
				return false;
			} else {
				if (id.length == "") {
					alert("User Name is empty");
					return false;
				}
				if (ps.length == "") {
					alert("Password field is empty");
					return false;
				}
			}
		}
	</script>
</body>

</html>