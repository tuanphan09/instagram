$(window).ready(function () {
	zoomImage('img_full', 600, 600);
	zoomImage('img_post_user', 293, 293);
	zoomImage('account_avatar', 170, 170);
})

function zoomImage(nameClass, width, height) {
	if (nameClass == 'img_update') {alert('ccc')}
	var img_post = document.getElementsByClassName(nameClass);
	for(var i = 0; i < img_post.length; i++){
		var img = img_post[i];
		var imgWidth = img.naturalWidth;
		var imgHeight = img.naturalHeight;

		var w, h;
		if(imgHeight * width / imgWidth >= height){
			w = width;
			h = imgHeight * width / imgWidth;
		} else {
			h = height;
			w = imgWidth * height / imgHeight;
		}
		img.style.width = w + 'px';
		img.style.height = h + 'px';
		// console.log(nameClass + ' : ' + w + 'x' + h);
	}
}
