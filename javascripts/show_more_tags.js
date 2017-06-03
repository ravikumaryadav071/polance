var sc = 0;
var st = 0;
var sr = 0;
$(document).ready(function(){

	$('body').on('click', '#show_contris', function(){
		sc++;
		if(sc==1){
			$(this).parent().find('#show_more_contris').slideDown(500);
			$(this).html('Show Less');
		}else{
			sc=0;
			$(this).parent().find('#show_more_contris').slideUp(500);
			$(this).html('Show More');
		}
	});

	$('body').on('click', '#show_tags', function(){
		st++;
		if(st==1){
			$(this).parent().find('#show_more_tags').slideDown(500);
			$(this).html('Show Less');
		}else{
			st=0;
			$(this).parent().find('#show_more_tags').slideUp(500);
			$(this).html('Show More');
		}
	});

	$('body').on('click', '#show_refs', function(){
		sr++;
		if(sr==1){
			$(this).parent().find('#show_more_refs').slideDown(500);
			$(this).html('Show Less');
		}else{
			sr=0;
			$(this).parent().find('#show_more_refs').slideUp(500);
			$(this).html('Show More');
		}
	});

});