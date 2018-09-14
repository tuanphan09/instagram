<?php
/**
* 
*/
class controller_post extends controller
{
	
	function __construct()
	{
		parent::__construct();
		$id = $_GET['id'];
		// get info post's owner
		$sql = "SELECT post.*, user.username, user.link_avatar FROM post, user 
		    WHERE post.id_user = user.id AND post.id = {$id}";
		$res = $this->model->query($sql, true);
		if($res === false) die("Failed controller post 1");
		$post = $res[0];

		// check if you follow this user or not
		$sql = "SELECT id FROM follow WHERE follow.id_user = {$_SESSION['id_user']} AND follow.id_following = {$post['id_user']}";
		$follow = $this->model->query($sql, true);
		if($follow === false) die("Failed controller post 1.5");
		$post['follow'] = 0;
		if($follow !== NULL) $post['follow'] = $follow[0]['id'];

		// get comments for this post
		$sql = "SELECT A.id_user, A.username, A.link_avatar, comment.message, comment.date FROM comment, (SELECT interact.*, user.username, user.link_avatar FROM interact, user WHERE interact.id_post = {$id} AND interact.id_user=user.id) as A WHERE comment.id_interact = A.id ORDER BY comment.date ASC";
		$cmt = $this->model->query($sql, true);
		if($cmt === false) die("Failed controller post 2");
		// mention in comments
		for ($i=0; $i < count($cmt); $i++) { 
			$x = $this->model->mention($cmt[$i]['message']);
			if($x === false) die("Failed controller post 2.5");
			$cmt[$i]['message'] = $x['message'];
		}
		$post['comment'] = $cmt;

		// find people who loved this post
		$sql = "SELECT user.id as id_user FROM interact, user WHERE interact.id_post = {$id} AND interact.love = 1 AND interact.id_user = user.id";
		$love = $this->model->query($sql, true);
		if($love === false) die("Failed controller post 3");
		
		$post['love'] = array("quantity" => 0, "like" => false);
		if($love !== NULL) {
			$post['love']['quantity'] = count($love);
			// check if you liked this post or not
			for($j=0; $j < count($love); $j++)
				if($love[$j]['id_user'] == $_SESSION['id_user'])
					$post['love']['like'] = true;
		}

		include 'view/header.php';
		include 'view/post.php';
		include 'view/footer.php';
	}
}
new controller_post();
?>