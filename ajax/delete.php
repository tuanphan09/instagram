<?php
	session_start();
	include '../app/model.php';
	$conn = new database("instagram");

	$post_info = $conn->getRowArray("post", $_POST['id_post']);
	if($post_info === false){
		$error = "Failed 1";
		die($error);
	}
	if($post_info !== null && $_SESSION['id_user'] == $post_info['id_user']){

		// delete notification from mentions 
		$sql = "DELETE FROM notification
				WHERE notification.id IN (
				    SELECT mention.id_noti
					FROM mention
					WHERE mention.id_comment IN (
					    SELECT comment.id
					    FROM comment
					    WHERE comment.id_interact IN (
					        SELECT interact.id
					        FROM interact
					        WHERE interact.id_post = {$_POST['id_post']}
					    )
					)
				)";
		if($conn->query($sql) === false){
			$error = "Failed 2";
			die($error);
		}
		// delete notification from comments
		$sql = "DELETE FROM notification
				WHERE notification.id IN (
					SELECT comment.id_noti
					FROM comment
					WHERE comment.id_interact IN (
					    SELECT interact.id
					    FROM interact
					    WHERE interact.id_post = {$_POST['id_post']}
					)
				)";
		if($conn->query($sql) === false){
			$error = "Failed 3";
			die($error);
		}

		// delete mention in post
		$sql = "DELETE FROM mention 
				WHERE mention.id_comment IN (
					SELECT comment.id
					FROM comment
					WHERE comment.id_interact IN (
					    SELECT interact.id
					    FROM interact
					    WHERE interact.id_post = {$_POST['id_post']}
					)
				)";
		if($conn->query($sql) === false){
			$error = "Failed 4";
			die($error);
		}

		// delete comments in post
		$sql = "DELETE FROM comment 
				WHERE comment.id_interact IN (
					SELECT interact.id
				    FROM interact
				    WHERE interact.id_post = {$_POST['id_post']}
				)";
		if($conn->query($sql) === false){
			$error = "Failed 5";
			die($error);
		}

		// delete interacts in post
		$sql = "DELETE FROM interact
				WHERE interact.id_post = {$_POST['id_post']}
				";
		if($conn->query($sql) === false){
			$error = "Failed 6";
			die($error);
		}

		// delete post
		if($conn->delete("post", $_POST['id_post']) === false){
			$error = "Failed 7";
			die($error);
		}
	}	
	die("Done!");
?>