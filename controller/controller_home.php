<?php
/**
* 
*/
class controller_home extends controller
{
	
	function __construct()
	{
		parent::__construct();
		// posts info to show on newfeed
		$sql = "SELECT post.*, user.username, user.link_avatar FROM post, user WHERE (post.id_user = {$_SESSION['id_user']} OR post.id_user IN (SELECT id_following FROM follow WHERE follow.id_user = {$_SESSION['id_user']})) AND post.id_user = user.id ORDER BY post.date DESC";
		$post = $this->model->query($sql, true);
		if($post === false) die("Failed controller home 1");

		// interactions for each posts 
		for ($i=0; $i < count($post); $i++) { 
			// get comments
			$sql = "SELECT A.id_user, A.username, A.link_avatar, comment.message, comment.date FROM comment, (SELECT interact.*, user.username, user.link_avatar FROM interact, user WHERE interact.id_post = {$post[$i]['id']} AND interact.id_user=user.id) as A WHERE comment.id_interact = A.id ORDER BY comment.date ASC";
			$cmt = $this->model->query($sql, true);
			if($cmt === false) die("Failed controller home 2");

			// mention in comments
			for ($j=0; $j < count($cmt); $j++) { 
				$x = $this->model->mention($cmt[$j]['message']);
				if($x === false) die("Failed controller home 2.5");
				$cmt[$j]['message'] = $x['message'];
			}
			$post[$i]['comment'] = $cmt;

			// people who loved this post
			$sql = "SELECT user.id as id_user FROM interact, user WHERE interact.id_post = {$post[$i]['id']} AND interact.love = 1 AND interact.id_user = user.id";
			$love = $this->model->query($sql, true);
			if($love === false) die("Failed controller home 3");
			$post[$i]['love'] = array("quantity" => 0, "like" => false);
			if($love !== NULL) {
				$post[$i]['love']['quantity'] = count($love);
				for($j=0; $j < count($love); $j++)
					if($love[$j]['id_user'] == $_SESSION['id_user'])
						$post[$i]['love']['like'] = true;
			}
		}
		
		include 'view/header.php';
		include 'view/home.php';
		include 'view/footer.php';
	}
}
new controller_home();
?>