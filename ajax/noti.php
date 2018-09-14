<?php
	session_start();
	session_write_close();
	include '../app/model.php';
	$conn = new database("instagram");

// check if you have notifications
	if($_POST['request'] == 'checkNoti'){
		$time = 0;
		while(true){
			$result = $conn->getRowArray('user', $_SESSION['id_user']);
			if($result === false){
				die('false');
			} 	
			if($result['noti'] == 1) die('1');
			$time += 2;
			if($time >= $_POST['timeout'])
				die('0');
			sleep(2);
		}
		die('0');
	}

// get your notification 

	// get notifications from comments
	$sql = "SELECT interact.id_post, post.link_img, interact.id_user, user.username, user.link_avatar, comment.message, comment.date FROM comment, notification, interact, post, user WHERE notification.noti_type = 'c' AND comment.id_noti = notification.id AND interact.id = comment.id_interact AND post.id = interact.id_post AND interact.id_user = user.id AND notification.id_user = {$_SESSION['id_user']}";
	$noti['c'] = $conn->query($sql, true);
	if($noti['c'] === false) die("Failed to get comment noti");

	// get notification from mentions
	$sql = "SELECT interact.id_user, user.username, user.link_avatar, interact.id_post, post.link_img, comment.message, comment.date FROM notification, comment, mention, interact, user, post WHERE noti_type = 'm' AND mention.id_noti = notification.id AND mention.id_comment = comment.id AND comment.id_interact = interact.id AND interact.id_user = user.id AND post.id = interact.id_post AND notification.id_user = {$_SESSION['id_user']}";
	$noti['m'] = $conn->query($sql, true);
	if($noti['m'] === false) die("Failed to get mention noti");

	// get notifications from being followed
	$sql = "SELECT follow.id_user, user.username, user.link_avatar, follow.date FROM notification, follow, user WHERE noti_type = 'f' AND follow.id_noti = notification.id AND user.id = follow.id_user AND notification.id_user = {$_SESSION['id_user']}";
	$noti['f'] = $conn->query($sql, true);

	// check if you follow a person who follow you
	$sql = "SELECT id_following FROM follow WHERE id_user = {$_SESSION['id_user']}";
	$following = $conn->query($sql, true);
	if($following === false || $noti['f'] === false)
		die("Failed to get follow noti");
	for ($i=0; $i < count($noti['f']); $i++) { 
		$check = false;
		for ($j=0; $j < count($following); $j++) { 
			if($noti['f'][$i]['id_user'] == $following[$j]['id_following']){
				$check = true;
				break;
			}
		}
		$noti['f'][$i]['isFollowing'] = $check;
	}


// return html format

	foreach ($noti as $type => $arr) {
		for ($i=0; $i < count($arr); $i++) { 
			$anoti = $arr[$i];
			$tr = "<tr>";
			$tr .= '
			<td class="td1">
				<a href="index.php?controller=account&id='.$anoti['id_user'].'"><img src="public/'.$anoti['link_avatar'].'" class="avatar">
				</a>
			</td>';
			if($type == 'f'){
				$tr .= '
				<td class="td2">
					<a href="index.php?controller=account&id='.$anoti['id_user'].'">
						<span class="username">'.$anoti['username'].'</span>
						 started following you <span class="date"> '.(changeDateTime($anoti['date'], 1)).'</span>
					</a>
				</td>
				<td class="td3">
					<span  '.($anoti['isFollowing'] ? '' : 'class="follow"').' onclick="clickToFollow(this, '.$anoti['id_user'].')">'.($anoti['isFollowing'] ? 'Following' : 'Follow').'</span>
				</td>';
			} else {
				if($type == 'm') $m = " mention you in a comment: ";
				else $m = " commented: ";
				$tr .= '
				<td class="td2">
					<a href="index.php?controller=account&id='.$anoti['id_user'].'">
						<span class="username">'.$anoti['username'].'</span>
					</a>
					<a href="index.php?controller=post&id='.$anoti['id_post'].'"> 
						'.$m.' '.$anoti['message'].'<span class="date"> '.(changeDateTime($anoti['date'], 1)).'</span>
					</a>
				</td>
				<td class="td3">
					<a href="index.php?controller=post&id='.$anoti['id_post'].'"><img src="public/'.$anoti['link_img'].'"></a>
				</td>';
			}
			$tr .= "</tr>";

			$notis[$anoti['date']] = $tr;
		}
	}
	if(isset($notis)){
		$result = '<table>';
		krsort($notis);
		foreach ($notis as $key => $value) {
			// $result .= "<tr><td>{$key}</td></tr>";
			$result .= $value;
		}
		$result .= '</table>';
	} else {
		$result = "<p style='width: 100%;	text-align: center; padding-top: 10px;'>WELLCOME TO INSTAGRAM<p>";
	}

	$data = array('noti' => 0);
	if($conn->update('user', $data, $_SESSION['id_user']) === false){
		die('Failed noti update user');
	}
	die($result);
?>