<?php
	session_start();

	include 'app/model.php';
	include 'app/controller.php';

	if(isset($_SESSION['id_user'])) {
		$controller = isset($_GET['controller']) ? $_GET['controller']:"home";
		if($controller == 'login') $controller = 'home';
	} else {
		$controller = 'login';
	}
	include "./controller/controller_$controller.php";
?>