<?php
	session_start();
	$user = $_SESSION['user'];
	echo $user;
	unset($_SESSION['user']);
    echo "<script>window.location.href='index.php';</script>";
?>