
// show Red Point if you have notification
var hasNoti = false;
function checkNoti(){
	// console.log('check');
	$.ajax({
		url : 'ajax/noti.php',
		type : 'post',
		data : {
			request : 'checkNoti',
			timeout : 30
		},
		dataType : 'text',
		success : function(result){
			console.log("checkNoti = " + result);
			if(result == 'false'){
				alert('Error to check noti');
			} else {
				if(result == '1'){
					$('#header > #noti > p').css('display', 'block');
					hasNoti = true;
				} else if (result == '0'){
					hasNoti = false;
					checkNoti();
				}
			}
		}, 
		timeout : 30000
	})	
	
}
checkNoti();


// show notification

$('body').click(function(){
	$('body #noti > div').css('display', 'none');
})
$('body #noti').click(function(e){
	e.stopPropagation();
})
$('#noti > img').click(function (e) {
	e.stopPropagation();
	$.ajax({
		url : 'ajax/noti.php',
		type : 'post',
		data : {
			request : 'getNoti'
		},
		dataType : 'text',
		success : function(result){
			console.log('get noti');
			// console.log(result);
			$('#noti > div').html(result);
			$('#noti > div').css('display', 'block');
			$('#header > #noti > p').css('display', 'none');
			if(hasNoti){
				hasNoti = false;
				checkNoti();
			}
		}
	})
})



// search

function search(ele) {
	$.ajax({
		url : 'ajax/search.php',
		type : 'post',
		data : {
			value : $(ele).val()
		}, 
		dataType : 'text',
		success : function (result) {
			$('#header > #search > div').html(result);
		}
	})
}
$('body').click(function(){
	$('#header #search > div').html('');
	$('#header #search > input').val('');
})
$('#header #search').click(function (e) {
	e.stopPropagation();
})


// log out
function logout() {
	$.ajax({
		url : 'ajax/logout.php',
		type : 'post',
		success : function (result) {
			window.location = "index.php";
		}
	})
}

// upload image + post : edit profile
$('#uploadFile').change(function () {
	var formData = new FormData($(this).parent()[0]);
	$.ajax({
		url : 'ajax/upload.php',
		type : 'POST',
		data : formData,
		processData: false,  // tell jQuery not to process the data
		contentType: false,  // tell jQuery not to set contentType
		success : function(result) {
			console.log(result);
			if(result == '' || result.search("<br") >= 0){
				alert("Can't upload your file");
			} else {
				// caption <div class="caption"><input type="text" name="caption" placeholder="Write a caption..."></div>
				var html = '<div class="row"><span onclick="postImage(\''+result+'\')">POST</span></div><div class="upload"><img class="img_upload" src="public/'+result+'"></div>';
				$('#listLikes .list').html(html);
	          	$('#listLikes').css('display', 'block');
			}
		}
	});
})
// click button "POST"
function postImage(img) {
	var caption = $('#listLikes > .list > .caption input').val();
	$.ajax({
		url : 'ajax/post.php',
		type : 'post',
		data : {
			caption : caption,
			link_img : img
		},
		dataType : 'json',
		success : function (result) {
			// console.log(result);
			if(typeof result['error'] == 'undefined'){
				window.location = 'index.php?controller=home'; 
			} else {
				alert("Can't post your image");
			}
		}

	})
}

// delete posts
function deletePost(id_post){
	console.log("delete post" + id_post);
	$.ajax({
		url : 'ajax/delete.php',
		type : 'post',
		data : {
			id_post: id_post
		},
		dataType : 'text',
		success : function (result) {
			console.log(result);
			window.location = 'index.php?controller=home';
		}

	})
}