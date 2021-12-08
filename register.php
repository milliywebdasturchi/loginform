<?php

session_start();

if(isset($_SESSION['username'])) {
	header("Location: index.php");
	exit();
}

include "dbconfig.php";

$error = array();
$success = array();
$username = $email = $password = $cpassword = "";

if(isset($_POST["register"])) {

	$fullname = mysqli_real_escape_string($conn, $_POST["fullname"]);
	$username = mysqli_real_escape_string($conn, $_POST["username"]);
	$email = mysqli_real_escape_string($conn, $_POST["email"]);
	$password = mysqli_real_escape_string($conn, $_POST["password"]);
	$cpassword = mysqli_real_escape_string($conn, $_POST["cpassword"]);

	// Check fields and parametrs
	if($username === "") {
		array_push($error, "Username maydoni to'ldirilmadi.");
	} else if(preg_match("/a-zA-Z/", $username)) {
		array_push($error, "Username maydoni faqat lotin harflaridan iborat bo'lishi kerak.");
	}
	if($email === "") {
		array_push($error, "Email maydoni to'ldirilmadi.");
	} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		array_push($error, "Noto'g'ri e-mail manzil kiritildi.");
	}
	if($password === "" && $cpassword === "") {
		array_push($error, "Password va confirm password maydonlari to'ldirilmadi.");
	} else if($password !== $cpassword) {
		array_push($error, "Password and confirm password maydonlariga bir xil parol kiritilmadi.");
	} else if(strlen($password) < 6)  {
		array_push($error, "Parol eng kamida 6 ta belgidan iborat bo'lishi kerak.");
	} else {
		// Check username or email database		
		$queryUser = mysqli_query($conn, "SELECT * FROM users WHERE username = '{$username}' OR email = '{$email}'");
		$user = mysqli_fetch_array($queryUser);		
		if($user > 0) {
			array_push($error, "Bunday foydalanuvchi yoki e-mail manzil bazada mavjud.");
		} else {
			// Password hash
			$PassHash = sha1($password);

			// Regsiter date now
			date_default_timezone_set("Asia/Tashkent");
			$regdate = date("d.m.Y H:i:s");

			// Check fullname fields
			if($fullname === "") {
				// insert database
				$insertQuery = mysqli_query($conn, "INSERT INTO users(fullname, email, username, password, role, status, regdate) VALUES (null,'{$email}','{$username}','{$PassHash}','user','active','{$regdate}')");

				// Check database inserted
				if($insertQuery) {
					array_push($success, "Siz muvaffaqiyatli ro'yxatdan o'tdingiz.");
				} else {
					array_push($error, "Ro'yxatdan o'tishda xatolik mavjud.");
				}
			} else {
				// insert database
				$insertQuery = mysqli_query($conn, "INSERT INTO users(fullname, email, username, password, role, status, regdate) VALUES ('$fullname','$email','$username','$PassHash','user','active','$regdate')");

				// Check database inserted
				if($insertQuery) {
					array_push($success, "Siz muvaffaqiyatli ro'yxatdan o'tdingiz.");
				} else {
					array_push($error, "Ro'yxatdan o'tishda xatolik mavjud.");
				}
			}

			
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ro'yxatdan o'tish</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="wrapper">
		<h1>Ro'yxatdan o'tish</h1>
		<?php 
			if(count($error) > 0) {
				echo "<span class='errors'>";
					foreach($error as $errors){
						echo " - " . $errors . "<br>";
					}
				echo "</span>";
			} 
			if(count($success) > 0) {
				echo "<span class='success'>";
					foreach($success as $successA){
						echo " - " . $successA . "<br>";
					}
				echo "</span>";
			} 
		?>
		<form action="" method="post">
			<input type="text" name="fullname" placeholder="Ismingizni kiriting">
			<input type="text" name="username" placeholder="Taxallus kiriting">
			<input type="text" name="email" placeholder="E-mail kiriting">
			<input type="password" name="password" placeholder="Parol kiriting">
			<input type="password" name="cpassword" placeholder="Parolni qayta kiriting">
			<button type="submit" name="register">Ro'yxatdan o'tish</button>
		</form>
		<p>
			Siz avval ro'yxatdan o'tganmisiz? <a href="login.php">Kirish</a>
		</p>
	</div>
</body>
</html>