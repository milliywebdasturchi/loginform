<?php

session_start();

if(isset($_SESSION['username'])) {
	session_unset($_SESSION['username']);
	session_destroy($_SESSION['username']);
	header("Location: login.php");
	exit();
}