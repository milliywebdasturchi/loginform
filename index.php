<?php

session_start();

if(!isset($_SESSION['username'])) {
	header("Location: login.php");
	exit();
} else {
	include "dbconfig.php";

	$username = $_SESSION['username'];

	$sqlUser = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' OR email = '$username'");
	$res = mysqli_fetch_assoc($sqlUser);

	$id = $res['id'];
	$fullname = $res['fullname'];
	$username = $res['username'];
	$email = $res['email'];
	$role = $res['role'];
	$status = $res['status'];

}





?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>User panel</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">
		<h3>User Info</h3>
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
			<a href="logout.php">Chiqish</a>
		</p>		
		<?php
			if($role === 'admin') {
		?>
		<hr>
		<h3>Users</h3>		
			<a style="float: left; text-decoration: none; color: #33cc33;" href="add_user.php">Add user</a><br><br>
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Ism</th>
					<th>E-mail</th>
					<th>Login</th>
					<th>Role</th>
					<th>Status</th>
					<th>Amallar</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$sql = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
					$i = 0;
					while($row = mysqli_fetch_assoc($sql)) {
						$i++;

				?>
				<tr>
					<td><?=$i;?></td>
					<td><?=$row['fullname'];?></td>
					<td><?=$row['email'];?></td>
					<td><?=$row['username'];?></td>
					<td><?=$row['role'];?></td>
					<td><?=$row['status'];?></td>
					<td>
						<a style="text-decoration: none; color: #4aaaa5;" href="view.php?id=<?=$row['id'];?>">View</a> | 
						<a style="text-decoration: none; color: #33cc33;" href="update.php?id=<?=$row['id'];?>">Update</a> | 
						<a style="text-decoration: none; color: #ff0000;" href="delete.php?id=<?=$row['id'];?>">Delete</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php } ?>		
	</div>
</body>
</html>