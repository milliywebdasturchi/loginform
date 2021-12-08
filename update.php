<?php

session_start();

if($_SESSION['role'] === 'user') {
	header("Location: index.php");
	exit();
} else {
	include "dbconfig.php";

	if(isset($_GET['id'])) {
		$id = $_GET['id'];

		$sqlUser = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
		$res = mysqli_fetch_assoc($sqlUser);

		$fullname = $res['fullname'];
		$username = $res['username'];
		$email = $res['email'];
		$role = $res['role'];
		$status = $res['status'];
	}
}

$errors = array();
$success = array();

if(isset($_POST['update'])) {
	$userId = mysqli_real_escape_string($conn, $_POST['id']);
	$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);  
	$username = mysqli_real_escape_string($conn, $_POST['username']);  
	$email = mysqli_real_escape_string($conn, $_POST['email']);  
	$password = mysqli_real_escape_string($conn, $_POST['password']);  
	$role = mysqli_real_escape_string($conn, $_POST['role']);  
	$status = mysqli_real_escape_string($conn, $_POST['status']);

	if($fullname === "") {
		array_push($errors, "Ism maydoni to'ldirilmadi.");
	}
	if($username === "") {
		array_push($errors, "Login maydoni to'ldirilmadi.");
	} else if(preg_match("/a-zA-Z/", $username)) {
		array_push($errors, "Login maydoni faqat lotin harflaridan iborat bo'lishi kerak.");
	}
	if($email === "") {
		array_push($errors, "E-mail maydoni to'ldirilmadi.");
	} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		array_push($error, "Noto'g'ri e-mail manzil kiritildi.");
	} else {
		$passHash = sha1($password);
		date_default_timezone_set("Asia/Tashkent");
		$updateDate = date("d.m.Y H:i:s");

		$updateQuery = mysqli_query($conn, "UPDATE users SET fullname = '$fullname', username = '$username', email = '$email', password = '$passHash', role = '$role', status = '$status', updateDate = '$updateDate' WHERE id = '$userId'");

		if($updateQuery) {
			array_push($success, "Foydalanuvchi muvaffaqiyatli saqlandi.");
		} else {
			array_push($errors, "Foydalanuvchini taxrirlashda xatolik mavjud.");
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Update user - <?=$id;?></title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="wrapper">
		<h3>Update user - <?=$id;?></h3>
		<?php 
			if(count($errors) > 0) {
				echo "<span class='errors'>";
					foreach($errors as $error){
						echo " - " . $error . "<br>";
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
			<input type="hidden" name="id" value="<?=$id;?>">
			<input type="text" name="fullname" value="<?=$fullname;?>">
			<input type="text" name="username" value="<?=$username;?>">
			<input type="text" name="email" value="<?=$email;?>">
			<input type="password" name="password">
			<select name="role">
				<option value="admin" <?php if($role === 'admin'){echo "selected";} ?>>Admin</option>
				<option value="user" <?php if($role === 'user'){echo "selected";} ?>>User</option>
			</select>
			<select name="status">
				<option value="active" <?php if($status === 'active'){echo "selected";} ?>>Active</option>
				<option value="ban" <?php if($status === 'ban'){echo "selected";} ?>>BAN</option>
			</select>
			<button type="submit" name="update">Saqlash</button>
		</form>
		<p>
			<a href="index.php">Bosh sahifa</a>
		</p>	
	</div>
</body>
</html>