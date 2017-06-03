$(document).ready(function(){

	$('body #post').each(function(){

		if($(this).height() > 50){

			$(this).css({
				'height' : '50px',
				'overflow' : 'hidden'			
			});

			$(this).after('<div id="see_more"><a href="javascript: void(0)">Show More</a></div>');
		}
	
	});

	$('body').on('click', '#see_more', function(){

		$(this).parent().find('#post').animate({
			'height' : '100%'
		}, 1500);
		var alEx = $(this).parent().find('#see_less').html();
		if(alEx == undefined){
			$(this).after('<div id="see_less"><a href="javascript: void(0)">Show Less</a></div>');
		}else{
			$(this).parent().find('#see_less').show();
		}
		$(this).hide();

	});

	$('body').on('click', '#see_less', function(){
		$(this).parent().find('#post').css('height', '50px');
		$(this).parent().find('#see_more').show();
		$(this).hide();
	});

});