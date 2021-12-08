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

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>View user - <?=$id;?></title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="wrapper">
		<h3>View user - <?=$id;?></h3>
		<table>			
			<tbody>
				<tr>
					<th>Ism:</th>
					<td><?=$fullname;?></td>
				</tr>
				<tr>
					<th>Login:</th>
					<td><?=$username;?></td>
				</tr>
				<tr>
					<th>E-mail:</th>
					<td><?=$email;?></td>
				</tr>
				<tr>
					<th>Daraja:</th>
					<td><?=$role;?></td>
				</tr>
				<tr>
					<th>Status:</th>
					<td><?=$status;?></td>
				</tr>
			</tbody>
		</table>
		<p>
			<a href="index.php">Bosh sahifa</a>
		</p>	
	</div>
</body>
</html>