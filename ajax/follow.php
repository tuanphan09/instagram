<?php
	session_start();
	include '../app/model.php';
	$conn = new database("instagram");
	$result = array();
	// check if you've already followed this user 
	$sql = "SELECT * FROM `follow` WHERE id_user = {$_SESSION['id_user']} AND id_following = {$_POST['id_user']}";
	$res = $conn->query($sql, true);
	if($res === false){
		$result['error'] = "failed follow 1";
		die(json_encode($result));
	}
	if($res === NULL){  // if dont follow then start following $_POST['id_user']
		$data = array(
			'id_user' => $_POST['id_user'],
			'noti_type' => 'f'
		);
		$insert_id = $conn->insert('notification', $data); // create a noti
		if($insert_id === false){
			$result['error'] = "failed follow 2";
			die(json_encode($result));
		} 
		$data = array(
			'id_user' => $_SESSION['id_user'],
			'id_following' => $_POST['id_user'],
			'id_noti' => $insert_id,
			'date' => date('Y-m-d H:i:s')
		);
		if($conn->insert('follow', $data) === false){ // create a follow
			$result['error'] = "failed follow 3";
			die(json_encode($result));
		}

		$data = array('noti' => 1);
		if($conn->update('user', $data, $_POST['id_user']) === false){// noti
			$result['error'] = "failed follow 4";
			die(json_encode($result));
		}
	} else { // unfollow an remove notification
		if($conn->delete('notification', $res[0]['id_noti']) === false){
			$result['error'] = "failed follow 5";
			die(json_encode($result));
		}
		if($conn->delete('follow', $res[0]['id']) === false){
			$result['error'] = "failed follow 5";
			die(json_encode($result));
		}
	}
	die(json_encode($result));
?>