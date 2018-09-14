<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>
<body>
<div id="header">
	<div id="logo">
		<a href="index.php?controller=home"><img src="public/img/logo.png"></a>
	</div>
	<div id="search">
		<input type="text" name="search" placeholder="Search" onkeyup="search(this)">
		<div>
		</div>
	</div>
	<div id="post">
		<label for="uploadFile" style="cursor: pointer;">
			<img src="public/img/icon_camera.png">
		</label>
		<form style="display: none;">
			<input type="file" name="file" id="uploadFile">
		</form>
	</div>
	<div id="noti">
		<img src="public/img/icon_noti.png">
		<p></p>
		<div></div>
	</div>
	<div id="account">
		<a href="index.php?controller=account&id=<?php echo $_SESSION['id_user']; ?>"><img src="public/img/icon_account.png"></a>
	</div>
</div>
