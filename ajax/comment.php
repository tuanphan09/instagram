<?php
	session_start();
	include '../app/model.php';
	$conn = new database("instagram");
	$result = $_SESSION;

	$sql = "SELECT id FROM interact WHERE id_post = {$_POST['id_post']} AND id_user = {$_SESSION['id_user']}";
	$res = $conn->query($sql, true);
	if($res === false){
		$result['error'] = "Failed comment 1";
		die(json_encode($result));
	}
	if($res === NULL){ // create a interact, save in res
		$data = array(
			'id_user' => $_SESSION['id_user'],
			'id_post' => $_POST['id_post'],
			'love'    => 0
		);
		$x = $conn->insert('interact', $data);
		if($x === false){
			$result['error'] = "Failed comment 2";
			die(json_encode($result));
		} 
		$res[0] = array('id' => $x);
	} 
	// create a noti for a comment
	if($_SESSION['id_user'] != $_POST['id_user']){
		$data = array(
			'id_user' => $_POST['id_user'],
			'noti_type' => 'c'
		);	
		$noti_id = $conn->insert('notification', $data);
		if($noti_id === false){
			$result['error'] = "Failed comment 3";
			die(json_encode($result));
		} 
		$data = array('noti' => 1);
		if($conn->update('user', $data, $_POST['id_user']) === false){
			$result['error'] = "Failed comment 4";
			die(json_encode($result));
		}
	} else $noti_id = 0;
	
	// create a comment 
	$data = array(
		'id_interact' => $res[0]['id'],
		'id_noti' => $noti_id,
		'message' => $_POST['message'],
		'date' => date('Y-m-d H:i:s')
	);
	$comment_id = $conn->insert('comment', $data);
	if($comment_id === false){
		$result['error'] = "Failed comment 5";
		die(json_encode($result));
	}
 
	//create mentions has id_comment = {$comment_id}
	$comment = $conn->mention($_POST['message']);
	if($comment === false){
		$result['error'] = "Failed comment 6";
		die(json_encode($result));
	}

	$result['message'] = $comment['message'];

	for ($i=0; $i < count($comment['id_user']); $i++) { 
		if($comment['id_user'][$i] == $_SESSION['id_user'])
			continue;
		// create a noti
		$data = array(
			'noti_type' => 'm',
			'id_user' => $comment['id_user'][$i]
		);
		$noti_id = $conn->insert('notification', $data);
		if($noti_id === false){
			$result['error'] = "Failed comment 7";
			die(json_encode($result));
		}

		// create a mention
		$data = array(
			'id_noti' => $noti_id,
			'id_comment' => $comment_id
		);
		if($conn->insert('mention', $data) === false){
			$result['error'] = "Failed comment 8";
			die(json_encode($result));
		}
		// update status noti for user
		$data = array('noti' => 1);
		if($conn->update('user', $data, $comment['id_user'][$i]) === false){
			$result['error'] = "Failed comment 4";
			die(json_encode($result));
		}
	}
	
	die(json_encode($result));
?>