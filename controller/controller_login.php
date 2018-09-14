<?php
/**
* 
*/
class controller_login extends controller
{
	
	function __construct()
	{
		parent::__construct();

		if(isset($_POST['username'])) { 
			$username = $this->model->escape_string($_POST['username']);
			$password = $this->model->escape_string($_POST['password']);
			// search username in database
			$result = $this->model->query("select * from `user` where username = '$username';", true);
			if($result === false) die("Failed in controller_login 1");

			if(isset($_POST['signup'])) { // sign up

				if($result === NULL) {
					$data = array(
						'username' => $username,
						'password' => $password,
						'link_avatar' => 'img/avatar0.jpg',
						'noti' => 0
					);
					if(!$this->model->insert('user', $data))
						die('sign up: Failed!');
					$alert = "<span>Đăng kí thành công</span>";
				} else {
					$alert = "Tên đăng kí đã tồn tại";
				}
			} else if(isset($_POST['signin'])) { // sign in
				if($result === NULL) {
					$alert = "Tên đăng nhập sai";
				} else {
					if($result[0]['password'] == $password) {
						$_SESSION['id_user'] = $result[0]['id'];
						$_SESSION['username'] = $username;
						header("Location: index.php?controller=home");
					} else {
						$alert = "Mật khẩu sai";
					}
				}
			} 	
		}
		include 'view/login.php';
	}
}

new controller_login();
?>