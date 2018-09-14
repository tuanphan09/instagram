

function showList(id, type){

	$.ajax({
		url : 'ajax/list.php',
		type : 'post',
		data : {
			type : type,
			id : id
		},
		dataType : 'text',
		success : function(result){
			$('#listLikes > .list').html(result);
			// $('body').addClass('stopScroll');
			$('#listLikes').css('display', 'block');
		}
	})
}


$('#listLikes').on('click', function(){
	// $('body').removeClass('stopScroll');
	$(this).css('display', 'none');
})

$('#listLikes .list').click(function(e){
	e.stopPropagation();
})



