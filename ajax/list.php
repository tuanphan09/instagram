<?php
	session_start();
	include '../app/model.php';
	$conn = new database('instagram');
	
	if($_POST['type'] == 1){ 
	// get list Like of a post has id = $_POST['id']
		$sql = "SELECT interact.id_user, user.username, user.link_avatar FROM interact, user WHERE interact.id_post = {$_POST['id']} AND interact.love = 1 AND user.id = interact.id_user";

		$list = $conn->query($sql, true);
		if($list === false) die('Failed likes 1.1');	
	} else if($_POST['type'] == 2){
	//get list follower of a user has id = $_POST['id']
		$sql = "SELECT follow.id_user, user.username, user.link_avatar FROM follow, user WHERE id_following = {$_POST['id']} AND follow.id_user = user.id";
		$list = $conn->query($sql, true);
		if($list === false) die('Failed likes 1.2');	
	} else if($_POST['type'] == 3){
	//getList following of a user has id = $_POST['id']
		$sql = "SELECT follow.id_following as id_user, user.username, user.link_avatar FROM follow, user WHERE id_user = {$_POST['id']} AND follow.id_following = user.id";
		$list = $conn->query($sql, true);
		if($list === false) die('Failed likes 1.3');	
	} else die();
	
	// get list of people you following
	$sql = "SELECT id_following FROM `follow` WHERE id_user = {$_SESSION['id_user']}";
	$list_following = $conn->query($sql, true);
	if($list_following === false) die('Failed likes 2');

	$nameList = array('', 'Likes', 'Followers', 'Following');
	$result = "<div class='row' style='text-align: center; border-top: none; margin-bottom: 10px;'>{$nameList[$_POST['type']]}</div>";

	for ($i=0; $i < count($list); $i++) { 
		$love = $list[$i];
		$check = false; // check if this user is you
		for ($j=0; $j < count($list_following); $j++) { 
			if($love['id_user'] == $list_following[$j]['id_following']){
				$check = true;
				break;
			}
		}

		$result .= "
			<div class='row'>
				<div class='ele1'>
					<a href='index.php?controller=account&id=".$love['id_user']."'><img src='public/".$love['link_avatar']."'>
					 <span class='username'>   ".$love['username']."</span></a>
				</div>";
		if($_SESSION['id_user'] == $love['id_user']){
			$result .= "</div>";
		} else{
			if($check){
				$result .= "<div class='ele2'>
								<span onclick='clickToFollow(this, ".$love['id_user'].")'>Following</span>
							</div>
						</div>";
			} else {
				$result .= "<div class='ele2'>
								<span class='follow' onclick='clickToFollow(this, ".$love['id_user'].")'>Follow</span>
							</div>
						</div>";
			}
		}
	}
	die($result);
?>