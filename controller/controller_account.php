<?php
/**
* 
*/
class controller_account extends controller
{
	
	function __construct()
	{
		parent::__construct();

		$id = $_GET['id'];
		// get info
		$account = $this->model->getRowArray('user', $id);
		if($account === false) die('Failed account 0');

		// get all user's pots
		$sql = "SELECT post.* FROM post WHERE id_user = {$id} ORDER BY date";
		$post = $this->model->query($sql, true);
		if($post === false) die('Failed account 1');

		// count number of peole you follow
		$sql = "SELECT count(*) as quantity FROM follow WHERE id_user = {$id}";
		$following = $this->model->query($sql, true);
		if($following === false) die('Failed account 2');
		$following = $following[0]['quantity'];
		// get all follower
		$sql = "SELECT id_user FROM follow WHERE id_following = {$id}";
		$followers = $this->model->query($sql, true);
		if($followers === false) die('Failed account 2');
		$isFollowing = false;
		// check if you follow this user or not
		for ($i=0; $i < count($followers); $i++) { 
			if($_SESSION['id_user'] == $followers[$i]['id_user']){
				$isFollowing = true;
				break;
			}
		}

		include 'view/header.php';
		include 'view/account.php';
		include 'view/footer.php';
	}
}

new controller_account();
?>