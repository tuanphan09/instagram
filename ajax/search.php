<?php
	if($_POST['value'] == '') die();
	
	include '../app/model.php';
	$conn = new database("instagram");
	
	$sql = "SELECT id, link_avatar, username FROM `user` WHERE username LIKE '%{$_POST['value']}%'";
	$result = $conn->query($sql, true);
	if($result !== false){
		for ($i=0; $i < count($result); $i++) { 
			echo '<p><a href="index.php?controller=account&id='.$result[$i]['id'].'"><img src="public/'.$result[$i]['link_avatar'].'" class="avatar"><span class="username"> '.$result[$i]['username'].'</span></a></p>';
		}
	}
	
?>