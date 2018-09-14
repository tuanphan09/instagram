
var clickFollow = true;

function clickToFollow(ele, id_user) {
	if(!clickFollow) return false;
	clickFollow = false;
	$.ajax({
		url : "ajax/follow.php",
		type : "post",
		data : {
			'id_user' : id_user
		}, 
		dataType : "json",
		success : function(result){
			console.log(result);
			if(typeof result['error'] == 'undefined'){
				if($(ele).text() == "Following"){
					$(ele).text("Follow");
					$(ele).addClass('follow');
				} else {
					$(ele).text("Following");
					$(ele).removeClass('follow');		
				}
			} else {
				console.log(result['error']);
			}
		}
	}).always(function(){
		clickFollow = true;
	})
}