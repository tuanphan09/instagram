
<div class="wrapper_post" id="post<?php echo $post['id']; ?>">
	<div class="post_img">
		<img src="public/<?php echo $post['link_img']; ?>" 
		class = "img_full">
	</div> 
	<div class="post_info">
		<div class="post_user">
			<table><tr>
				<td>
					<a href="index.php?controller=account&id=<?php echo $post['id_user']; ?>">
						<img src="public/<?php echo $post['link_avatar']; ?>" class="avatar">
						<span class="username"><?php echo $post['username']; ?></span>
					</a>
				</td>
				<td>
				<?php if($_SESSION['id_user'] != $post['id_user']){
					if($post['follow'] > 0){ ?>
						<span onclick="clickToFollow(this, 
						<?php echo $post['id_user']; ?>)">Following</span>
					<?php } else { ?>
						<span class="follow" onclick="clickToFollow(this, 
						<?php echo $post['id_user']; ?>)">Follow</span>
					<?php } 
				} ?>
				</td>	
			</tr></table>

			<?php if($post['id_user'] == $_SESSION['id_user']){ ?>
			<div>
				<img src="public/img/3dots.png">
				<div onclick="deletePost(<?php echo $post['id']; ?>);">
					Delete
				</div>
			</div>	
			<?php } ?>
		</div>
		<div class="post_comment">
		<?php for ($j=0; $j < count($post['comment']); $j++) { 
			$cmt = $post['comment'][$j];
		?>
			<p>
				<a href="index.php?controller=account&id=<?php echo $cmt['id_user']; ?>"><span class="username"><?php echo $cmt['username']; ?></span></a>
				<?php echo $cmt['message']; ?>
			</p>
		<?php } ?>
			
		</div>
		<div class="post_interact post_love">
			<img src="public/<?php echo ($post['love']['like'] ? 'img/icon_full_love.png' : 'img/icon_empty_love.png'); ?>" 
			onclick="clickOnHeart(<?php echo $post['id']; ?>)"
			style="cursor: pointer;">
			<b style="cursor: pointer;" onclick="showList(<?php echo $post['id']; ?>, 1)">
				<?php $x = $post['love']['quantity']; 
					if($x == 0) echo "<span style='font-weight: normal;'>be the first to like this</span>";
					else echo $x.($x == 1 ? " like" : " likes");
				 ?>
			</b>
			<p class="date"><?php echo changeDateTime($post['date']); ?></p>
			<hr>
			<input type="text"  placeholder="Add a comment..."
			onkeypress="sendMessage(event, this, <?php echo $post['id']; ?>, <?php echo $post['id_user']; ?>)">
		</div>
	</div>
</div>

<script type="text/javascript" src="public/js/interact.js"></script>
