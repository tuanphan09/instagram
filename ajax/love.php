<?php
	session_start();
	include '../app/model.php';
	$conn = new database("instagram");
	$result = array();
  	$sql = "SELECT id, love FROM interact WHERE id_post = {$_POST['id_post']} AND id_user = {$_SESSION['id_user']}";
  	$res = $conn->query($sql, true);
	if($res === false){
		$result['error'] = "failed love 1";
		die(json_encode($result));
	}
	if($res === NULL){
		$data = array(
			'id_user' => $_SESSION['id_user'],
			'id_post' => $_POST['id_post'],
			'love' 	  => 1 
		);
		if($conn->insert('interact', $data) === false){
			$result['error'] = "failed love 3";
			die(json_encode($result));
		}
	} else {
		$data = array("love" => 1 - $res[0]['love']);
		if($conn->update("interact", $data, $res[0]['id']) === false){
			$result['error'] = "failed love 2";
			die(json_encode($result));
		}
	}
	die(json_encode($result));
?>