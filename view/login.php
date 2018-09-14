<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/login.css">
</head>
<body>
	<div>
		<img src="public/img/phone.png">
	</div>
	<div class="box-join">
		<div>
			<img src="public/img/logo.png">
		</div>
		<form method="POST" action="" id='formJoin'>
			<input type="text" placeholder="Username" class="data-input" name="username" required value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
			<input type="password" placeholder="Password" class="data-input" 
			name="password" required value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
			<button class="btn-submit" name="signin">Sign In</button>
			<button class="btn-submit" name="signup">Sign Up</button>
			<div class="alert"><?php if(isset($alert)) echo $alert; ?></div>
		</form>
	</div>
	<div>
		<a href="https://www.apple.com/lae/ios/app-store/"><img src="public/img/app.png"></a>
	</div>
</body>
</html>