<?php
/**
* 
*/
class controller_edit extends controller
{
	
	function __construct()
	{
		parent::__construct();
		$account = $this->model->getRowArray('user', $_SESSION['id_user']);
		
		if(isset($_POST['submit'])){
			$check = false;
			// change username
			if($_POST['username'] != '' && $_POST['username']!=$account['username']){
				$sql = "SELECT * FROM user WHERE username='".$_POST['username']."'";
				if($this->model->query($sql, true) === NULL){
					$account['username'] = $_POST['username'];
					$check = true;
				} else {
					$noti['error'] = "<p style='color: red;'>'".$_POST['username']."' has already existed!</p>";
				} 
			}
			
			// change password
			if($_POST['new_password'] != ''){
				if($_POST['old_password'] != $account['password']){
					$noti['error'] = "<p style='color: red;'>Password is wrong!</p>";
				} else {
					$check = true;
					$account['password'] = $_POST['new_password'];
				}
			}
			// change avatar
			if($_FILES['avatar']['name'] != '') $check = true;
			if(!isset($noti['error']) && $check){
				if($_FILES['avatar']['name'] != ''){
					$account['link_avatar'] = "img/avatar{$_SESSION['id_user']}.jpg";
					move_uploaded_file($_FILES['avatar']['tmp_name'], "public/".$account['link_avatar']);
				}
				if($this->model->update('user', $account, $account['id']) === false) 
					die('Failed edit');
				$noti['success'] = "<p style='color: green;'>Update successful!</p>";
			}
		} 
			
		include 'view/header.php';
		include 'view/edit.php';
		include 'view/footer.php';
	}
}
new controller_edit();

?>