<?php
	session_start();
	session_write_close();
	include '../app/model.php';
	$conn = new database("instagram");

	$data = array(
		'id_user'  => $_SESSION['id_user'],
		'link_img' => $_POST['link_img'] ,
		'date'     => date('Y-m-d H:i:s')
	);
	$id_post = $conn->insert('post', $data);

	if($id_post === false){
		$result['error'] = "Failed post 1";
		die(json_encode($result));
	}

	$result['id'] = $id_post;
	die(json_encode($result));
?>