<?php if($post === NULL){ ?>
<div class="no_post">
	<img src="public/img/no_post.png">;
</div>
<?php } else ?>
<div class="wrapper_home">
<?php
	for ($i=0; $i < count($post); $i++) { 
		$arr = $post[$i];
	?>
	<div class="post" id="post<?php echo $arr['id']; ?>">
		<div class="post_user">
			<a href="index.php?controller=account&id=<?php echo $arr['id_user']; ?>">
				<img src="public/<?php echo $arr['link_avatar']; ?>" class="avatar">
				<span class="username"><?php echo $arr['username']; ?></span>
			</a>
			<?php if($arr['id_user'] == $_SESSION['id_user']){ ?>
			<div>
				<img src="public/img/3dots.png">
				<div onclick="deletePost(<?php echo $arr['id']; ?>);">
					Delete
				</div>
			</div>	
			<?php } ?>
			
		</div>
		<div class="post_img">
			<a href="index.php?controller=post&id=<?php echo $arr['id']; ?>"><img src="public/<?php echo $arr['link_img']; ?>" class="img_full"></a>
		</div>
		<div class="post_love">
			<img src="public/<?php echo ($arr['love']['like'] ? 'img/icon_full_love.png' : 'img/icon_empty_love.png'); ?>" 
			onclick="clickOnHeart(<?php echo $arr['id']; ?>)"
			style="cursor: pointer;">
			<b style="cursor: pointer;" onclick="showList(<?php echo $arr['id']; ?>, 1)">
			<?php $x = $arr['love']['quantity']; 
				if($x == 0) echo "<span style='font-weight: normal;'>be the first to like this</span>";
				else echo $x.($x == 1 ? " like" : " likes");
			 ?></b>
		</div>
		<div class="post_comment">
			
		<?php for ($j=0; $j < count($arr['comment']); $j++) { 
			$cmt = $arr['comment'][$j];
		?>
			<p>
				<a href="index.php?controller=account&id=<?php echo $cmt['id_user']; ?>"><span class="username"><?php echo $cmt['username']; ?></span></a>
				<?php echo $cmt['message']; ?>
			</p>
		<?php } ?>
		</div>
		<div class="add_comment">
			<p class="date"><?php echo changeDateTime($arr['date']); ?></p>
			<hr>
			<input type="text" onkeypress="sendMessage(event, this, <?php echo $arr['id']; ?>, <?php echo $arr['id_user']; ?>)" placeholder="Add a comment...">
		</div>
	</div>
<?php } ?>
</div>

<script type="text/javascript" src="public/js/interact.js"></script>
