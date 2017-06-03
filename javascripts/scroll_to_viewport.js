$(document).ready(function(){

	var scrollHere = $('body #scrollHere').offset();
	var sh = scrollHere.top;
	//$('body #scrollHere').parent().scrollTop(sh);
	setTimeout(function(){
		$(document).scrollTop(sh);
	}, 1000)
	
});