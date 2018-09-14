
// WEB Socket
var wsUri = "ws://localhost:8080";   
websocket = new WebSocket(wsUri); 
    
//Connected to server
websocket.onopen = function(ev) {
	console.log('Connected to server ');
}

//Connection close
websocket.onclose = function(ev) { 
    console.log('Disconnected');
};

//Message Receved
websocket.onmessage = function(ev) { 
    var data = JSON.parse(ev.data);
    if(data['type'] == 'comment'){ // update comment
    	$('#post'+data['id_post']+" .post_comment").append(data['message']);
    } else { // update love
    	changeQuantityLove(data['id_post'], data['status']);
    }
};

//Error
websocket.onerror = function(ev) { 
    console.log('Error '+ev.data);
};

// comment

var pressEnter = true;
function sendMessage(event, ele, id_post, id_user) {
	var x = event.which || event.keyCode;
	if($(ele).val() == " ") $(ele).val("");
	if(x == 13 && pressEnter && $(ele).val() != ""){
		pressEnter = false;
		$.ajax({
			url : "ajax/comment.php",
			type : "post",
			data : {
				id_post : id_post,
				id_user : id_user,
				message : $(ele).val()
			},
			dataType : "json",
			success : function(result){
				// console.log(result);
				if(typeof result['error'] == 'undefined'){
					var cmt = $(ele).parent().parent().children('.post_comment');
					var p = '<p><a href="index.php?controller=account&id='+ result['id_user'] +'"><span class="username">'+ result['username'] +'</span></a> ' + result['message'] +'</p>';
					cmt.append(p);
					var data = {
						'id_post' : id_post,
						'type' : 'comment',
						'message' : p
					}
					websocket.send(JSON.stringify(data));
				} else {
					console.log(result['error']);
				}
			}
		}).always(function(){
			pressEnter = true;
			$(ele).val("");
		})
	}
}

// love 

var clickLove = true;

function clickOnHeart(id_post){
	if(clickLove == false) return true;
	clickLove = false;

	$.ajax({
		url : "ajax/love.php",
		type : "post",
		data : {
			id_post : id_post
		},
		dataType : "json",
		success : function(result){
			if(typeof result['error'] == 'undefined'){
				var img = $('#post' + id_post + ' .post_love img')
				var src = img.attr('src');
				var status;
				if(src.search('empty_love') >= 0){
					src = src.replace('empty_love', 'full_love');
					status = 1;
				} else {
					src = src.replace('full_love', 'empty_love');
					status = -1;				
				}
				img.attr('src', src);
				changeQuantityLove(id_post, status);
				var data = {
						'id_post' : id_post,
						'type' : 'love',
						'status' : status
					};
				websocket.send(JSON.stringify(data));
			} else {
				console.log(result['error']);
			}
		}
	}).always(function(){
		clickLove = true;
	})
}
function changeQuantityLove(id_post, status){
	var img = $('#post' + id_post + ' .post_love img')
	var like = $('#post' + id_post + ' .post_love b');
	var x = parseInt(like.text());
	if(isNaN(x)) x = 0;
	x += status;
	if(x == 0){
		like.html("<span style='font-weight: normal;'> be the first to like this</span>");
	} else {
		like.text(x + (x == 1 ? " like" : " likes"));
	} 
}

