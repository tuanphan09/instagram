<div class="edit">
	<form action="" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Username</td>
				<td>
					<input type="text" name="username" value="<?php echo isset($noti['error']) ? ($_POST['username']) :  ''; ?>">
				</td>
			</tr>
			<tr>
				<td>Avatar</td>
				<td>
					<input type="file" name="avatar">
				</td>
			</tr>
			<tr>
				<td>Old Password</td>
				<td>
					<input type="password" name="old_password"  value="<?php echo isset($noti['error']) ? ($_POST['old_password']) :  ''; ?>">
				</td>
			</tr>
			<tr>
				<td>New Password</td>
				<td>
					<input type="password" name="new_password"  value="<?php echo isset($noti['error']) ? ($_POST['new_password']) :  ''; ?>">
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="submit">
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<?php 
						if(isset($noti)){
							echo isset($noti['error']) ? $noti['error'] : $noti['success'];
						}
					?>
				</td>
			</tr>
		</table>	
	</form>
	
</div>