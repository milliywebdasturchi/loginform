<?php

session_start();

if(isset($_SESSION['username'])) {
	header("Location: index.php");
	exit();
}

include "dbconfig.php";

// Xatoliklar massivini e'lon qilish
$errors = array();

if(isset($_POST["login"])) {

	$username = mysqli_real_escape_string($conn, $_POST["username"]);
	$password = mysqli_real_escape_string($conn, $_POST["password"]);

	// Form maydonlarini bo'sh yoki bo'sh emasligini tekshirish
	if($username === "") {
		array_push($errors, "Login maydoni to'ldirilmadi.");
	}
	if($password === "") {
		array_push($errors, "Parol maydoni to'ldirilmadi.");
	} else {
		// Foydalanuvchini bazadan tekshirish
		$queryUser = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' OR email = '$username'");
		$res = mysqli_fetch_assoc($queryUser);
		
		if(count($res) === 0) {
			array_push($errors, "Bunday foydalanuvchi ro'yxatdan o'tmagan.");
		} else {
			if($res['status'] === 'ban') {
				array_push($errors, "Sizning akkauntingiz bloklangan.");
			} else {
				// Parolni xeshlash
				$passHash = sha1($password);

				if($res['password'] !== $passHash) {
					array_push($errors, "Parol xato kiritildi.");
				} else {
					$_SESSION['username'] = $res['username'];
					$_SESSION['role'] = $res['role'];
					header("Location: index.php");
					exit();
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
	<title>Kirish</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="wrapper">
		<h1>Kirish</h1>
		<?php 
			if(count($errors) > 0) {
				echo "<span class='errors'>";
					foreach($errors as $error){
						echo " - " . $error . "<br>";
					}
				echo "</span>";
			} 			 
		?>
		<form action="" method="post">
			<input type="text" name="username" placeholder="Login">
			<input type="password" name="password" placeholder="Parol">
			<button type="submit" name="login">Kirish</button>
		</form>
		<p>
			Siz ro'yxatdan o'tganmisiz? <a href="register.php">Ro'yxatdan o'tish</a>
		</p>
	</div>
</body>
</html>