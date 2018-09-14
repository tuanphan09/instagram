<div class="wrapper_account">
	<div class="user_info">
		<table>
			<tr>
				<td class="td1">
					<img src="public/<?php echo $account['link_avatar'] ?>" class="account_avatar">
				</td>
				<td class="td2">
					<div>
						<h1><?php echo $account['username']; ?></h1>
						<p>
							<?php 
								if($_SESSION['id_user'] == $id)
									echo "<a href='index.php?controller=edit'><span>Edit Profile</span></a></p><p onclick='logout()'><span>Log Out</span>";
								else if($isFollowing)
									echo "<span  onclick='clickToFollow(this, {$id})'>Following</span>";
								else echo "<span class='follow' onclick='clickToFollow(this, {$id})'>Follow</span>";
							?>
						</p>
					</div>
					<div>
						<p><b><?php echo count($post) ?></b> posts</p>
						<p onclick="showList(<?php echo $id ?>, 2)"><b><?php echo count($followers) ?></b> followers</p>
						<p onclick="showList(<?php echo $id ?>, 3)"><b><?php echo $following ?></b> following</p>
					</div>
				</td>
			</tr>
		</table>
	</div>

	<div class="post_img">
		<?php
			if(count($post) == 0){
				echo "<img src='public/img/no_post.png'>";
			} else {
				for ($i=0; $i < count($post); $i++) { 
		?>
		<div>
			<a href="index.php?controller=post&id=<?php echo($post[$i]['id']) ?>"><img src="public/<?php echo($post[$i]['link_img']) ?>" class="img_post_user"></a>
		</div>
		<?php
				}
			}
		?>
	</div>
</div>